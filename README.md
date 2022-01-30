Installation notes:

1. Unpack zip
2. Copy .env-dist to .env
3. Check and parameters in .env if needed
4. Build docker image, create and run containers

   docker-compose build
   
   docker-compose up
   
5. Update your 'hosts' file by adding corresponding records for FE_HOST and BE_HOST params.

   Example: 
	127.0.0.1 fe.test.com
	127.0.0.1 be.test.com 		
	
6.   Now you can check CRUD set of pages entering be.test.com:8888 in your browser.
   
7.   To check REST API method you should install Postman plugin to Chrome (or some other plugin with similar functionality)
	 Now you can enter the following data in Postman:
	 
	 Url: http://fe.test.com:8888/todo/todo-done
	 Method: Post
	 Data: form-data
	 Parameters: 
			id    <some value>
			done  <some value>
					