package de.uniulm.in.ki.webeng.serverscaffold;

import java.io.*;
import java.nio.file.Files;

import org.w3c.dom.Document;

import de.uniulm.in.ki.webeng.serverscaffold.model.Response;

import javax.xml.XMLConstants;
import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.transform.Source;
import javax.xml.transform.dom.DOMSource;
import javax.xml.transform.stream.StreamSource;
import javax.xml.validation.Schema;
import javax.xml.validation.SchemaFactory;
import javax.xml.validation.Validator;

public class ResponseValidator {
    /**
     * Validate the given response and transform it into more desirable format.
     * Also ensures caching of responses
     *
     * @param remoteResponse
     *            The original response or null, if no response was provided
     * @return The transformed response, which might also be pulled from the
     *         cache
     */
    public static Response validate(Response remoteResponse)
            throws UnsupportedEncodingException {
        if (remoteResponse == null) {
            System.out.println("no remote response");
            return loadCache();
        }
        System.out.println("remote response: ");
        System.out.println(remoteResponse);
        if (isValidXML(remoteResponse)) {
            System.out.println("valid xml");
            remoteResponse = transformResponse(remoteResponse);
            saveCache(remoteResponse);
            return remoteResponse;
        }
        return loadCache();
    }

    /**
     * Stores a response to the local cache
     *
     * @param remoteResponse
     *            The original response
     */
    public static void saveCache(Response remoteResponse) {
        try {
            FileOutputStream fileOutputStream = new FileOutputStream(
                    "cache.sav");

            ObjectOutputStream objectOutputStream = new ObjectOutputStream(
                    fileOutputStream);
            objectOutputStream.writeObject(remoteResponse);
            objectOutputStream.close();

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public static void clearCache() {
        if (Files.exists(ServerConfiguration.cachePath)) {
            try {
                Files.delete(ServerConfiguration.cachePath);
            } catch (IOException e) {
                e.printStackTrace();
            }
        }
    }

    /**
     * Loads a response from the local cache
     *
     * @return The cached response
     */
    public static Response loadCache() {
        if (!Files.exists(ServerConfiguration.cachePath)) {
            Response err = new Response();
            err.setResponseCode(500, "Internal Server Error");
            return err;
        }

        try {
            FileInputStream fileInputStream = new FileInputStream(
                    ServerConfiguration.cachePath.toFile());
            ObjectInputStream objectOutputStream = new ObjectInputStream(
                    fileInputStream);

            Response response = (Response) objectOutputStream.readObject();
            // System.out.println(response.contentLength());

            objectOutputStream.close();

            return response;
        } catch (IOException | ClassNotFoundException e) {
            e.printStackTrace();
        }
        return null;
    }

    private static Document extractXML(Response remoteResponse) {
        DocumentBuilder documentBuilder = null;
        InputStream bodyStream = null;
        Document document = null;
        try {
            documentBuilder = DocumentBuilderFactory.newInstance().newDocumentBuilder();
            bodyStream = new ByteArrayInputStream(remoteResponse.getBody());
            document = documentBuilder.parse(bodyStream);
            bodyStream.close();
        } catch (Exception e) {
            e.printStackTrace();
        }
        return document;
    }

    /**
     * Checks the body of the provided response for validity
     *
     * @param remoteResponse
     *            The original response
     * @return True, if the provided XML is valid
     */
    public static boolean isValidXML(Response remoteResponse) {
        SchemaFactory schemaFactory = null;
        Source schemaSource = null;
        Schema schema = null;
        Validator validator = null;
        Document document = extractXML(remoteResponse);
        if (document == null)
            return false;

        File schemaFile = new File("PriceSchema.xsd");
        try {
            schemaFactory = SchemaFactory.newInstance(XMLConstants.W3C_XML_SCHEMA_NS_URI);
            // Load the XML schema
            schemaSource = new StreamSource(schemaFile);
            schema = schemaFactory.newSchema(schemaSource);

            // Create a Validator instance, which can be used to validate an instance document
            validator = schema.newValidator();
        } catch (Exception e) {
            e.printStackTrace();
        }

        // Validate the DOM tree
        try {
            validator.validate(new DOMSource(document));
        } catch (Exception e) {
            // XML is invalid!
            return false;
        }

        return true;
    }

    /**
     * Transforms the content of the provided response into a more desirable
     * format
     *
     * @param remoteResponse
     *            The original response
     * @return A transformed response
     */
    public static Response transformResponse(Response remoteResponse) {
        return remoteResponse;
    }
}
