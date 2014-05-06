Pantry-Butler
=============
The Pantry Butler is a combination meal planner and shopping list generator. You tell the site what cuisines you like and it plans meals for the next month. With those meals it can determine which ingredients you need and how much. To start out, you’ll need to manually respond that you have an ingredient, or that you need more, or that you don’t have it and another meal will be planned. With the pantry information it can determine your shopping list so you’re ready for the meals on the upcoming week. Once you’ve bought an ingredient the site knows how much you have and how much you use (when making meals) and so knows automatically when you need it again.

Because the site is generating the meals and the shopping lists those should be all the user needs. For this reason the navbar only shows two options – Cook! and Shopping List.

However, there are also advance options under Manage. These include preferences, a pantry screen for manually entering and editing your ingredient inventory, calendar views to change your meal plans, a create recipe page to make your own, and a view recipe page for comments, ratings, and lookup.

The site uses a database to store user information, recipe information, and store information. These tables support several different goals

    General Information, including Author names, Tool descriptions, Ingredient images, etc.
    Meal plan generation and storage
    User comments, statistics, and rating for each recipe, ingredient, etc.
    Cooking instructions for each recipe
    Recipe details including allergns and cuisine listings
    Future Goal – let users upload recipes and cite source
    Future Goal – show preferred brands first
    Future Goal – specify shopping list for each store by keeping track of their inventories

The site is not complete, but has some functionality implemented:

    All page layouts have been done, navigation works
    Pulls information from database for Initial Setup, Cook, and Signup
    Looks great on tablet and phone, switches to a vertical layout

Known problems:

    Certain pages block navbar dropdowns
    Meals don’t disappear after adding to calendar in Initial Setup
    Can’t scroll on touch phones

To pull information from the database I have created a DatabaseObject trait. PHP traits are like Java interfaces, in that they cannot be instantiated, but are like inheritable classes in that they can have non-static/final variables and defined functions.

This class interfaces with the database through constructors and get/set functions. The constructors enforce every instantiation (through inheriting classes like Recipe and Tool) to match one row in one table. If a query retrieves multiple rows then the caller gets an array of objects, one for each row. The  __set function intercepts normal variable usage ($myRecipe->Name = “new”) and passes the change to the database. The __get function intercepts normal variable usage ($name = $myRecipe->Name) and returns null if the object/row has been deleted.

This greatly simplifies my code. For the cook slideshow I needed three queries on seven tables and 150 lines of code to turn the results into a recipe data structure I could use. The page needs the recipe name, an array of steps, an array of all ingredients combined from all steps and an array of all tools combined from all steps. Also, each step includes a tool, instructions, and an array of ingredients for that step.

With the new code, all I had to do was construct a recipe from a recipe ID, construct an array of steps from a query narrowing on that recipe ID, construct an array of ingredients narrowing on that recipe ID, and then sort the ingredients into their respective steps. Overall, 20 lines of code. It is now much more legible and obvious as well.

The data flow is described in this image. You can find code here. I would suggest starting with DatabaseObject.trait.php under Utility and Super Classes. That is used/inherited by Recipe.class.php under Database Representations. Those basic classes are composed into a RecipeOverview.class.php, under Database Composites. That RecipeOverview object is created by the Cook.php page, under Pages – Basic. (It is also used by through an AJAX interface/page – see InitialSetup.php and InitialSetup.ajax.php under Pages – That Access the Database).

All code can be found here, in collapsable sections. Just click on the page’s title to see a scrollable printout.

 

I hope to continue on this through the summer. However, I need to take a serious look at versioning – work on showing the cook slideshow before I allow users to edit on the fly, etc. I also need to look at better form/javascript formatting so users can use the site without javascript. Or I need to require javascript, find a way to tell the users, and use ajax instead of forms. I also need to focus on generating small, repeatable pieces of page through php/ajax. As of now I copy and paste and it will be difficult to make any modifications. Finally, I think I need a slightly different theme – white on grey and text-shadows is really nice, but it prevents you from using any other colors.
