package de.uniulm.in.ki.webeng.serverscaffold;

import java.io.*;
import java.nio.file.Files;

import de.uniulm.in.ki.webeng.serverscaffold.model.Response;

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
    public static Response validate(Response remoteResponse) {
        Response response = null;

        if(remoteResponse == null || !isValidXML(remoteResponse)) {
            response = loadCache();
            if(response == null) {
                response = new Response();
                response.setResponseCode(500, "Internal Server Error");
            } else {
                return transformResponse(response);
            }
        } else {
            saveCache(remoteResponse);
            response = transformResponse(remoteResponse);
        }
        return response;
    }

    /**
     * Deletes the cache file if it exists
     */
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
     * Stores a response to the local cache
     *
     * @param remoteResponse
     *            The original response
     */
    public static void saveCache(Response remoteResponse) {
        try {
            File file = ServerConfiguration.cachePath.toFile();
            if(!file.exists()){
                file.createNewFile();
            }

            FileOutputStream fos = new FileOutputStream(file);
            ObjectOutputStream oos = new ObjectOutputStream(fos);

            oos.writeObject(remoteResponse);

            fos.close();
            oos.close();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    /**
     * Loads a response from the local cache
     *
     * @return The cached response
     */
    public static Response loadCache() {
        Response response = null;

        try {
            FileInputStream fi = new FileInputStream(ServerConfiguration.cachePath.toFile());
            ObjectInputStream oi = new ObjectInputStream(fi);

            response = (Response) oi.readObject();

            oi.close();
            fi.close();
        } catch (Exception e) {
            e.printStackTrace();
        }

        return response;
    }

    /**
     * Checks the body of the provided response for validity
     *
     * @param remoteResponse
     *            The original response
     * @return True, if the provided XML is valid
     */
    public static boolean isValidXML(Response remoteResponse) {
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
