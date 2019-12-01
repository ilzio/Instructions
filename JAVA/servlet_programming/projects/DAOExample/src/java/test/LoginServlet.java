package test;

import javax.servlet.*;
import javax.servlet.http.*;
import java.io.*;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.logging.Level;
import java.util.logging.Logger;

public class LoginServlet extends HttpServlet {

    public void doPost(HttpServletRequest req, HttpServletResponse res)
            throws ServletException, IOException {
        PrintWriter pw = res.getWriter();
        res.setContentType("text/html");

        String username = req.getParameter("username");
        String password = req.getParameter("password");
     
        try {
            Connection con = ConnectionFactory.connection();
            PreparedStatement ps = con.prepareStatement("select * from Login where username=? and password=?");
            ps.setString(1, username);
            ps.setString(2, password);
            ResultSet rs = ps.executeQuery();

            if (rs.next()) {
                pw.println("Login Successful");
                RequestDispatcher rd = req.getRequestDispatcher("dis");
                rd.forward(req, res);
            } //end of if
            else {
                pw.println("Invalid username or password");
                RequestDispatcher rd = req.getRequestDispatcher("login.html");
                rd.include(req, res);
            }

            ps.close();
            rs.close();
            
            

        } catch (Exception ex) {
            Logger.getLogger(LoginServlet.class.getName()).log(Level.SEVERE, null, ex);
        }

    }
}
