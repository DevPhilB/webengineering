package de.uniulm.in.ki.webeng.serverscaffold;

import java.util.HashMap;
import java.util.Map;

import de.uniulm.in.ki.webeng.serverscaffold.model.Request;

/**
 * Assembles a request byte by byte
 *
 * Created by Markus Brenner on 07.09.2016.
 * Modified by Samuel Fritz & Philipp Backes on 26.10.2019.
 */
public class HTTPMessageBuilder {
    // For cleaner code
    private static final int ZERO = 0;
    private static final int ONE = 1;
    private static final int TWO = 2;
    private static final String SPACE = " ";

    private static final String CONTENT_LENGTH = "Content-Length";
    private String message = "";

    // The part of the request.
    private String method, resource, protocol;
    private Map<String, String> headers = new HashMap<>();
    private byte[] body = null;

    // States of reading.
    private boolean headerPart = true;
    private boolean hasBody = false;

    private char oldChar = 'Q';
    private int counter = ZERO, colon = ZERO;
    private boolean noSecondColon = true;

    // Body part.
    private int bodyLength = ZERO, contentCounter = ZERO;
    private String bodyContent = "";

    /**
     * Appends a character to the current request.
     *
     * @param c The next character
     * @return True, if the addition of the provided byte has completed the request
     */
    public boolean append(byte c) {
        // Read next character.
        char nextChar = (char) (c & 0xFF);
        // Parse header information.
        if (headerPart) {
            if (nextChar == '\n' && oldChar == '\r' && message.length() > ZERO) {
                if (colon == ZERO) {
                    // Checks the first message without a : in it.
                    this.method = message.substring(ZERO, message.indexOf(SPACE));
                    this.resource = message.substring(message.indexOf(SPACE) + ONE, message.lastIndexOf(SPACE));
                    this.protocol = message.substring(message.lastIndexOf(SPACE) + ONE);
                } else {
                    // Sets the header values from the message.
                    if (message.substring(ZERO, colon + ONE).equals(SPACE)) {
                        this.headers.put(message.substring(ZERO, colon), message.substring(colon + TWO));
                    } else {
                        this.headers.put(message.substring(ZERO, colon), message.substring(colon + ONE));
                    }
                }
                counter = ZERO;
                message = "";
                noSecondColon = true;
            } else if (nextChar == '\n' && oldChar == '\r') {
                // End of the message.
                if (this.headers.containsKey(CONTENT_LENGTH)) {
                    bodyLength = Integer.valueOf(this.headers.get(CONTENT_LENGTH));
                    hasBody = true;
                } else { // Request has no body.
                    return true;
                }
            }

            // Checks the first colon in the message.
            if (nextChar == ':' && noSecondColon) {
                colon = counter;
                noSecondColon = false;
            }
            // Append next character if there is no paragraph.
            if (nextChar != '\n' && nextChar != '\r') {
                counter++;
                message += nextChar;
            }
            oldChar = nextChar;
        }

        // Body part read bodyLength bytes.
        if (hasBody) {
            if (bodyLength > contentCounter) {
                bodyContent += nextChar;
            } else {
                this.body = bodyContent.getBytes();
                // Body ended.
                return true;
            }
            contentCounter++;
        }
        return false;
    }

    /**
     * Obtains the assembled request
     *
     * @return The assembled request or null, if the request has not been completed
     *         yet
     */
    public Request getRequest() {
        // Handle requests without message-body
        if (body == null) body = "message-body=false".getBytes();
        return new Request(method, resource, protocol, headers, body);
    }
}