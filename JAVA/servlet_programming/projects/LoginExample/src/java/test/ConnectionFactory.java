/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package test;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;


/**
 *
 * @author $USERNAME
 */
public class ConnectionFactory {

public static Connection connection() throws SQLException, ClassNotFoundException{

    //conectar no banco 
    Class.forName("com.mysql.jdbc.Driver");
    return DriverManager.getConnection("jdbc:mysql://localhost/javatest", "test", "test");
    
}
    
}
