open-graph-cakephp
==================

Open graph integration for Cakephp 

First of all download this code and move opengraph directory to app/Vendor directory.

Also created Sample Controller method and ajax response for the opengraph view.

Create view open-graph view method in your controller.

I am assuming you have OpenGraphController.php file.

In your OpenGraphController.php file.

Create function opengraph and copy code from cakephp-view-controler-file/OpenGraphController.php in your controller.

And also create view file named as opengraph.ctp in your view folder of that controller.

Now copy code cakephp-view-controler-file/opengraph.ctp in that view file.

This is ajax response view file.

Now, you have to create main file where you are firing ajax request to this controller's method.

I am assuming, you have app/View/Users/main.ctp file.

Now, copy code from cakephp-view-controler-file/opengraph.ctp to app/View/Users/main.ctp.

And access this url from the browser.

for example :

http://localhost/your-application/users/main

I am also added UsersController.php file for this main method.


=================================================================================================================

<b>How to test it without Cakephp ?</b>
--------------------------------

You could also check the open graph example by copying opengraph folder in your www directory and access it using following url.

http://localhost/opengraph

==================================================================================================================

ParagKuhikar @http://justprogrammer.com & http://kuhikar.com

 
