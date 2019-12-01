
package test;

import java.io.*;
import javax.servlet.*;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.*;

@WebServlet("/servlet1") // -> sets url endpoint to run servlet!!! in address bar, same as web.xml declaration 

public class ServletProgram1 extends HttpServlet {
    
    public void init(){}
    
    public void service(ServletRequest req, ServletResponse res) throws IOException,ServletException {
        
        PrintWriter pw = res.getWriter();
        res.setContentType("text/html");
        pw.println("ciaocioa dasdas");
        }
        
    public void destroy(){}
        
        
        
    }

