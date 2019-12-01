
package test;

import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
public class DisplayServlet extends HttpServlet {
    //METHOD TO HANDLE FORM POST REQUESTS
    
    public void doPost(HttpServletRequest req, HttpServletResponse res)
    throws ServletException,IOException { 
    
    //USING PRINTWRITERD TO SEND DATA TO RESPONSE OBJECT AND SETTING RESPONSE CONTENT TYPE
        PrintWriter pw = res.getWriter();
        res.setContentType("text/html");
        
        String username = req.getParameter("username");
        
        pw.println("welcome " + username);
        
        
    }
}
