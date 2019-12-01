package com.nt.servlet;

import javax.servlet.*; //import servlet api 
import java.io.*; //for I/O streams 
import java.util.*;



//SERVLET COMPONENT 

//responsible for starting servlet ->must be public to be instatiatable by ServletContainer
public class DateServlet extends GenericServlet
{




//implementing abstract service method from GenericServlet, managing requests -> takes to arguments, request and response objects
	//servlet container takes care of everything, managing service methods, it calls it, user never does 
	public void service(ServletRequest req, ServletResponse res) throws ServletException,IOException{
		
		PrintWriter pw = null; // instantiates a printwriter object to be used below
		Date date=null; //instantiate date object

		//set response content type (html)
		res.setContentType("text/html");
		
		//get response object's Printwriter objet
		pw = res.getWriter(); // retrieve PrintWriter object from response [it is a stream, used to write/read data to/from destination (file, array, object), in this case it is used to write, send data to the response object ]
		
		//write request processing 
		date = new Date();
		
		// write output to response object 
		pw.println("<h1 style='align:center'> Date and time : " +date + "</h1>"  );
		
		//close stream and commits response, tells response object output is over and it relays to container   
		pw.close();

	} //service close
} //classe close 