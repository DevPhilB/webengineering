package de.uniulm.in.ki.webeng.serverscaffold.httphandlers;

import de.uniulm.in.ki.webeng.serverscaffold.MIMEHandler;
import de.uniulm.in.ki.webeng.serverscaffold.ServerConfiguration;
import de.uniulm.in.ki.webeng.serverscaffold.model.Request;
import de.uniulm.in.ki.webeng.serverscaffold.model.Response;

import java.nio.file.Path;

/**
 * Handles HEAD requests Created by Markus Brenner on 12.09.2016.
 */
public class HEADHandler {
    /**
     * Handles a request
     * 
     * @param request
     *            The request issued by a client
     * @param response
     *            An empty response object, which is to be filled with the
     *            correct reply
     */
    public static void handle(Request request, Response response) {
        String resource = request.resource.substring(1);
        resource = (resource.length() == 0) ? "index.html" : resource;
        Path resourcePath = ServerConfiguration.webRoot.resolve(resource);
        if (!resourcePath.normalize().startsWith(ServerConfiguration.webRoot.normalize())) {
            response.setResponseCode(401, "Unauthorized");
            response.addHeader("Connection", "close");
        } else {
            response.setResponseCode(200, "OK");
            response.addHeader("Content-Type", MIMEHandler.getMimeType(resourcePath));
            response.addHeader("Connection", "Keep-Alive");
        }
    }
}
