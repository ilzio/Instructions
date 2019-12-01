
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
        
    //GET NAME PARAMETER FROM REQUEST     
        String name = req.getParameter("name");
        String address = req.getParameter("address");
        String married = req.getParameter("married");
        String filhos = req.getParameter("filhos");
    //PRINTS IN RESPONSE    
        pw.println("name = " + name);
        pw.println("address = " + address);
        pw.println("married= " + married);
        pw.println("filhos= " + filhos);
          
          if (married.equals("null")) {
            pw.println("não é casado");
        } else {
              pw.println("é casado");
          }
        
    }
}
