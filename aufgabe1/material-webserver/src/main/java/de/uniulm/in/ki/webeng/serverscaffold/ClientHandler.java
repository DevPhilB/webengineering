package de.uniulm.in.ki.webeng.serverscaffold;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.Socket;

import de.uniulm.in.ki.webeng.serverscaffold.httphandlers.DELETEHandler;
import de.uniulm.in.ki.webeng.serverscaffold.httphandlers.GETHandler;
import de.uniulm.in.ki.webeng.serverscaffold.httphandlers.HEADHandler;
import de.uniulm.in.ki.webeng.serverscaffold.httphandlers.POSTHandler;
import de.uniulm.in.ki.webeng.serverscaffold.httphandlers.PUTHandler;
import de.uniulm.in.ki.webeng.serverscaffold.model.Request;
import de.uniulm.in.ki.webeng.serverscaffold.model.Response;

/**
 * Handler for client requests Spawned by {@link ServerThread} Created by Markus
 * Brenner on 07.09.2016.
 */
public class ClientHandler implements Runnable {
	private final Socket socket;
	private boolean terminate;
	private BufferedReader reader;

	/**
	 * Creates a new ClientHandler for the provided socket
	 * 
	 * @param socket The socket connected to the client
	 * @throws IOException If the socket operations threw an IOException
	 */
	public ClientHandler(Socket socket) {
		this.socket = socket;
		this.terminate = false;
	}

	/**
	 * Terminates this ClientHandler thread
	 */
	public void terminate() {
		this.terminate = true;
	}

	@Override
	public void run() {
		try {
			this.reader = new BufferedReader(new InputStreamReader(socket.getInputStream()));
			// read requests until the handler is terminated
			// start assembling a new request
			HTTPMessageBuilder current = new HTTPMessageBuilder();
			// until the request has been declared finished
			while (!terminate) {
				// read a byte from the client
				int r = reader.read();
				if (r == -1) {
					// client has terminated the connection, terminate the
					// handler
					terminate = true;
					break;
				}

				// append the byte to the current handler
				// if the request is read completely, handle it
				if (current.append((byte) r)) {
					System.out.println("Received request from client:");
					Request currentRequest = current.getRequest();
					System.out.println(currentRequest);

					Response resp = new Response();
					// process the request and generate a new response
					process(currentRequest, resp);

					// send the response back to the client and terminate the
					// connection
					OutputStream out = socket.getOutputStream();
					out.write(resp.toBytes());
					out.close();
					terminate = true;
					System.out.println("Response generated (header only):");
					System.out.println(resp.getHeader());

				}
			}
		} catch (IOException exc) {
			exc.printStackTrace();
		}
		System.out.println("Client terminated");
	}

	/**
	 * Process a request and produce a new response
	 * 
	 * @param request  The request issued by the client
	 * @param response An empty response object, which needs to be adapted to the
	 *                 correct result
	 */
	public void process(Request request, Response response) {
		// TODO: in exercise 3: assemble the response
		switch (request.method) {
		case "GET":
			System.out.println("GET HANDLER");
			GETHandler.handle(request, response);
			break;
		case "POST":
			System.out.println("POST HANDLER");
			POSTHandler.handle(request, response);
			break;
		case "HEAD":
			HEADHandler.handle(request, response);
			break;
		case "DELETE":
			DELETEHandler.handle(request, response);
			break;
		case "PUT":
			PUTHandler.handle(request, response);
			break;
		default:
			response.setResponseCode(405, "Method Not Allowed");
			break;
		}

		System.out.println("Request received. Request handling pending...");
	}
}
