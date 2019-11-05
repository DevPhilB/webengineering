package de.uniulm.in.ki.webeng.serverscaffold.httphandlers;

import java.io.IOException;
import java.nio.file.Path;

import de.uniulm.in.ki.webeng.serverscaffold.MIMEHandler;
import de.uniulm.in.ki.webeng.serverscaffold.ServerConfiguration;
import de.uniulm.in.ki.webeng.serverscaffold.model.Request;
import de.uniulm.in.ki.webeng.serverscaffold.model.Response;

/**
 * Handles GET requests Created by Markus Brenner on 07.09.2016.
 */
public class GETHandler {
	/**
	 * Handles a request
	 *
	 * @param request  The request issued by a client
	 * @param response An empty response object, which is to be filled with the
	 *                 correct reply
	 */
	public static void handle(Request request, Response response) {
		// TODO: complete
		String resource = request.resource.substring(1);
		resource = (resource.length() == 0) ? "index.html" : resource;
		Path resourcePath = ServerConfiguration.webRoot.resolve(resource);
		System.out.println("RESOURCE '" + resource + "' PATH '" + resourcePath + "'");
		if (!resourcePath.normalize().startsWith(ServerConfiguration.webRoot.normalize())) {
			// TODO; set response code
			response.setResponseCode(401, "Unauthorized");
			response.addHeader("Connection", "close");
		} else {
			// TODO: set body, content length header and response code
			response.setResponseCode(200, "OK");
			response.addHeader("Content-Type", MIMEHandler.getMimeType(resourcePath));
			response.addHeader("Connection", "Keep-Alive");
			try {
				response.setBody(resourcePath);
			} catch (IOException e) {
				// TODO Auto-generated catch block
				response.setResponseCode(400, "Not found");
				response.addHeader("Connection", "close");
				e.printStackTrace();
			}
		}
	}
}
