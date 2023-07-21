# Vincent_Lisa_1_repository_git_042023
Création de son premier blog en PHP

## Project description

The project consists in developing its professional blog. This website is divided into two main groups of pages:

- pages useful to all visitors ;
- pages allowing you to manage your blog.

Here is the list of pages that will be accessible from his website:

- the home page ;
- the page listing all the blog posts ;
- the page displaying a blog post ;
- the page allowing you to add a blog post;
- the page allowing you to modify a blog post;
- the pages allowing to modify/delete a blog post;
- the pages for logging in/registering users.
We need to develop an administration part that should be accessible only to registered and validated users.

The administration pages will therefore be accessible under certain conditions and we must ensure the security of the administration part.

## First step : Clone the repository

To clone the git repository you have to go into the folder "www" of your server (wamp, xamp, ...). Then, you can enter this commande line in your terminal :
```
git clone https://github.com/lisavincent31/Vincent_Lisa_1_repository_git_042023.git
cd Vincent_Lisa_1_repository_git_042023.git
```

## Second step : Create the environment

In your terminal tape the following lines :
```
composer dump-autoload
```

## Third step : Create the database

To change the connection configuration you have to go into public/index.php.
You can modify the constantes for the connection with yours in lignes 14 - 17.

Then, open the file into database/mysql/request.sql.
Cut and paste the requests into the request SQL of your database software.

You have now access to a few lignes for the blog (users, posts, comments).