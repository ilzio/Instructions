
package test;

import java.io.*;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.*;
import javax.servlet.http.*;
public class DisplayServlet extends HttpServlet {


//HERE WE RETRIEVE INIT PARAMETER SPECIFIED IN THE WEB.XML

//    public int count; //declare variable we are going to use to contain value
//    
//    public void init(ServletConfig sc){
//        count = Integer.parseInt(sc.getInitParameter("count"));
//         
//    }
//    
    


//METHOD TO HANDLE FORM POST REQUESTS
    
    public void doPost(HttpServletRequest req, HttpServletResponse res)
    throws ServletException,IOException { 
    
    //USING PRINTWRITERD TO SEND DATA TO RESPONSE OBJECT AND SETTING RESPONSE CONTENT TYPE
        PrintWriter pw = res.getWriter();
        res.setContentType("text/html");
        
        String username = req.getParameter("username");
        
        pw.println("welcome " + username);
//        pw.println("initialization paramenter count is " +count);
        try {
            Connection con = ConnectionFactory.connection();
            
            PreparedStatement ps = con.prepareStatement("select * from Login where username = ?");
            ps.setString(1, username);
        
            ResultSet rs = ps.executeQuery();
            
           
            
            while (rs.next()) {         
                
               int id = rs.getInt("id");
               String nome = rs.getString("username");
               String senha =rs.getString("password");
               
               pw.println("id = " +id);
               pw.println("nome = " +nome);
               pw.println("password = " +senha);
               
               
//                
//         
            }
            
            ps.close();
            rs.close();
            
           
            
            
            
        } catch (SQLException ex) {
            Logger.getLogger(DisplayServlet.class.getName()).log(Level.SEVERE, null, ex);
        } catch (ClassNotFoundException ex) {
            Logger.getLogger(DisplayServlet.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        
    }
}
