USE c1510a03test;

/* Reset enviornment
DROP TABLE UserRecipeInfo;
DROP TABLE Calendar;
DROP TABLE UserIngredientInfo;
DROP TABLE UserStoreInfo;
DROP TABLE PantryInventory;
DROP TABLE GroceryList;
DROP TABLE StoreInventory;

DROP TABLE Store;

DROP TABLE RecipeStepIngredient;
DROP TABLE RecipeStep;
DROP TABLE Recipe;

DROP TABLE Tool;
DROP TABLE Measurement;
DROP TABLE Preparation;
DROP TABLE Ingredient;
DROP TABLE Author;
DROP TABLE Brand;
DROP TABLE Cuisine;
DROP TABLE User;
*/

-- Table setup
-- User tables
CREATE TABLE User (
	UserID			INT			AUTO_INCREMENT PRIMARY KEY,
	Password		VARCHAR(30)		NOT NULL,
	Email			VARCHAR(30)		NOT NULL,
	ZipCode			CHAR(5)
);
CREATE TABLE UserRecipeInfo (
	UserID			INT,
	RecipeID		INT,
	AuthorIDOverwrite	INT,
	BrandIDOverwrite	INT,
	FirstCook		DATE,
	LastCook		DATE,
	NumberOfCooks		SMALLINT UNSIGNED,
	Rating			TINYINT UNSIGNED,
	AveragePrice		FLOAT,
	PRIMARY KEY(UserID, RecipeID)
);
CREATE TABLE UserIngredientInfo (
	UserID			INT,
	IngredientID		INT,
	Allergn			BIT(1)			DEFAULT 0,
	PRIMARY KEY(UserID, IngredientID)
);
CREATE TABLE UserStoreInfo (
	UserID			INT,
	StoreID			INT,
	Rating			TINYINT UNSIGNED,
	FirstUsed		DATE,
	LastUsed		DATE,
	NumberOfUses		SMALLINT UNSIGNED,
	AverageSpending		FLOAT,
	PRIMARY KEY(UserID, StoreID)
);
CREATE TABLE PantryInventory (
	UserID			INT,
	IngredientID		INT,
	Amount			FLOAT,
	MeasurementID		VARCHAR(15),
	RunOutDate		DATE,
	PRIMARY KEY(UserID, IngredientID)
);
CREATE TABLE GroceryList (
	UserID			INT,
	IngredientID		INT,
	Priority		INT UNSIGNED,
	PRIMARY KEY(UserID, IngredientID)
);
CREATE TABLE Calendar (
	UserID			INT,
	RecipeID		INT,
	PlannedDate		DATE,
	PRIMARY KEY(UserID, RecipeID, PlannedDate)
);

-- Recipe tables
CREATE TABLE Recipe (
	RecipeID		INT			AUTO_INCREMENT PRIMARY KEY,
	Name			VARCHAR(20)		NOT NULL,
	CuisineID		VARCHAR(20),
	UserIDCreator		INT,
	CookingTime		TIME,
	Source			TINYTEXT,
	AuthorID		INT,
	BrandID			INT,
	Image			BLOB,
	Servings		TINYINT
);
CREATE TABLE Cuisine (
	CuisineName		VARCHAR(20)		PRIMARY KEY
);
CREATE TABLE RecipeStep (
	RecipeID		INT,
	Step			TINYINT UNSIGNED,
	Instructions		TEXT,
	UserIDCreator		INT,
	ToolID			INT,
	PRIMARY KEY(RecipeID, Step)
);
CREATE TABLE RecipeStepIngredient (
	RecipeID		INT,
	StepID			TINYINT UNSIGNED,
	IngredientID		INT,
	Amount			FLOAT,
	MeasurementID		VARCHAR(15),
	PreparationID		VARCHAR(15),
	PreferredBrand		INT,
	UserIDCreator		INT,
	PRIMARY KEY(RecipeID, StepID, IngredientID)
);

-- Store
CREATE TABLE Store (
	StoreID			INT			AUTO_INCREMENT PRIMARY KEY,
	BrandID			INT			NOT NULL,
	Address			TINYTEXT
);
CREATE TABLE StoreInventory (
	StoreID			INT,
	IngredientID		INT,
	Price			FLOAT(3,2),
	Quantity		INT UNSIGNED,
	PRIMARY KEY(StoreID, IngredientID)
);

-- Misc
CREATE TABLE Ingredient (
	IngredientID		INT			AUTO_INCREMENT PRIMARY KEY,
	Name			VARCHAR(20)		NOT NULL,
	Description		TINYTEXT,
	Image			BLOB,
	UserIDCreator		INT
);
CREATE TABLE Tool (
	ToolID			INT			AUTO_INCREMENT PRIMARY KEY,
	Name			VARCHAR(20),
	UserIDCreator		INT,
	Appliance		BIT,
	Utensil			BIT
);
CREATE TABLE Measurement (
	MeasurementName		VARCHAR(15)		PRIMARY KEY
);
CREATE TABLE Preparation (
	PreparationName		VARCHAR(15)		PRIMARY KEY
);
CREATE TABLE Author (
	AuthorID		INT			AUTO_INCREMENT PRIMARY KEY,
	FirstName		VARCHAR(20)		NOT NULL,
	LastName		VARCHAR(20),
	WebSite			TINYTEXT,
	Image			BLOB
);
CREATE TABLE Brand (
	BrandID			INT			AUTO_INCREMENT PRIMARY KEY,
	BrandName		VARCHAR(20),
	WebSite			TINYTEXT,
	Image			BLOB
);

-- Relationship setup
-- User relationships
ALTER TABLE      UserStoreInfo
  ADD CONSTRAINT UserStoreFKUserID
  FOREIGN KEY    (UserID)
    REFERENCES   User(UserID)
    ON DELETE    CASCADE;
    
ALTER TABLE      UserStoreInfo
  ADD CONSTRAINT UserStoreFKStoreID
  FOREIGN KEY    (StoreID)
    REFERENCES   Store(StoreID)
    ON DELETE    CASCADE;
    
ALTER TABLE      UserRecipeInfo
  ADD CONSTRAINT UserRecipeFKUserID
  FOREIGN KEY    (UserID)
    REFERENCES   User(UserID)
    ON DELETE    CASCADE;
    
ALTER TABLE      UserRecipeInfo
  ADD CONSTRAINT UserRecipeFKRecipeID
  FOREIGN KEY    (RecipeID)
    REFERENCES   Recipe(RecipeID)
    ON DELETE    CASCADE;
    
ALTER TABLE      UserRecipeInfo
  ADD CONSTRAINT UserRecipeFKBrandID
  FOREIGN KEY    (BrandIDOverwrite)
    REFERENCES   Brand(BrandID)
    ON DELETE    SET NULL;
    
ALTER TABLE      UserRecipeInfo
  ADD CONSTRAINT UserRecipeFKAuthorID
  FOREIGN KEY    (AuthorIDOverwrite)
    REFERENCES   Author(AuthorID)
    ON DELETE    SET NULL;
    
ALTER TABLE      UserIngredientInfo
  ADD CONSTRAINT UserIngredientFKUserID
  FOREIGN KEY    (UserID)
    REFERENCES   User(UserID)
    ON DELETE    CASCADE;
    
ALTER TABLE      UserIngredientInfo
  ADD CONSTRAINT UserIngredientFKIngredientID
  FOREIGN KEY    (IngredientID)
    REFERENCES   Ingredient(IngredientID)
    ON DELETE    CASCADE;
    
ALTER TABLE      PantryInventory
  ADD CONSTRAINT PantryInventoryFKUserID
  FOREIGN KEY    (UserID)
    REFERENCES   User(UserID)
    ON DELETE    CASCADE;
    
ALTER TABLE      PantryInventory
  ADD CONSTRAINT PantryInventoryFKIngredientID
  FOREIGN KEY    (IngredientID)
    REFERENCES   Ingredient(IngredientID)
    ON DELETE    CASCADE;
    
ALTER TABLE      PantryInventory
  ADD CONSTRAINT PantryInventoryFKAmountType
  FOREIGN KEY    (MeasurementID)
    REFERENCES   Measurement(MeasurementName)
    ON DELETE    SET NULL;
    
ALTER TABLE      GroceryList
  ADD CONSTRAINT GroceryListFKUserID
  FOREIGN KEY    (UserID)
    REFERENCES   User(UserID)
    ON DELETE    CASCADE;
    
ALTER TABLE      GroceryList
  ADD CONSTRAINT GroceryListFKIngredientID
  FOREIGN KEY    (IngredientID)
    REFERENCES   Ingredient(IngredientID)
    ON DELETE    CASCADE;

ALTER TABLE      Calendar
  ADD CONSTRAINT CalendarFKUserID
  FOREIGN KEY    (UserID)
    REFERENCES   User(UserID)
    ON DELETE    CASCADE;

ALTER TABLE      Calendar
  ADD CONSTRAINT CalendarFKRecipeID
  FOREIGN KEY    (RecipeID)
    REFERENCES   Recipe(RecipeID)
    ON DELETE    CASCADE;
    
-- Recipe Relationships
ALTER TABLE      Recipe
  ADD CONSTRAINT RecipeFKCuisineID
  FOREIGN KEY    (CuisineID)
    REFERENCES   Cuisine(CuisineName)
    ON DELETE    SET NULL;
    
ALTER TABLE      Recipe
  ADD CONSTRAINT RecipeFKAuthorID
  FOREIGN KEY    (AuthorID)
    REFERENCES   Author(AuthorID)
    ON DELETE    SET NULL;

ALTER TABLE      Recipe
  ADD CONSTRAINT RecipeFKBrandID
  FOREIGN KEY    (BrandID)
    REFERENCES   Brand(BrandID)
    ON DELETE    SET NULL;

ALTER TABLE      RecipeStep
  ADD CONSTRAINT RecipeStepFKRecipeID
  FOREIGN KEY    (RecipeID)
    REFERENCES   Recipe(RecipeID)
    ON DELETE    CASCADE;
    
ALTER TABLE      RecipeStep
  ADD CONSTRAINT RecipeStepFKToolID
  FOREIGN KEY    (ToolID)
    REFERENCES   Tool(ToolID)
    ON DELETE    SET NULL;

ALTER TABLE      RecipeStepIngredient
  ADD CONSTRAINT RecipeStepIngredientFKRecipeStep
  FOREIGN KEY    (RecipeID, StepID)
    REFERENCES   RecipeStep(RecipeID, Step)
    ON DELETE    CASCADE
    ON UPDATE    CASCADE;

ALTER TABLE      RecipeStepIngredient
  ADD CONSTRAINT RecipeStepIngredientFKIngredientID
  FOREIGN KEY    (IngredientID)
    REFERENCES   Ingredient(IngredientID)
    ON DELETE    CASCADE;

ALTER TABLE      RecipeStepIngredient
  ADD CONSTRAINT RecipeStepIngredientFKMeasurementID
  FOREIGN KEY    (MeasurementID)
    REFERENCES   Measurement(MeasurementName)
    ON DELETE    CASCADE;

ALTER TABLE      RecipeStepIngredient
  ADD CONSTRAINT RecipeStepPreparationFKPreparationID
  FOREIGN KEY    (PreparationID)
    REFERENCES   Preparation(PreparationName)
    ON DELETE    CASCADE;


-- Store Relationships
ALTER TABLE      Store
  ADD CONSTRAINT StoreFKBrandID
  FOREIGN KEY    (BrandID)
    REFERENCES   Brand(BrandID)
    ON DELETE    CASCADE;
    
ALTER TABLE      StoreInventory
  ADD CONSTRAINT StoreInventoryFKStoreID
  FOREIGN KEY    (StoreID)
    REFERENCES   Store(StoreID)
    ON DELETE    CASCADE;

ALTER TABLE      StoreInventory
  ADD CONSTRAINT StoreInventoryFKIngredientID
  FOREIGN KEY    (IngredientID)
    REFERENCES   Ingredient(IngredientID)
    ON DELETE    CASCADE;
    
-- User Created/Input Relationships
ALTER TABLE      Ingredient
  ADD CONSTRAINT IngredientFKUserIDCreator
  FOREIGN KEY    (UserIDCreator)
    REFERENCES   User(UserID)
    ON DELETE    SET NULL;
    
ALTER TABLE      Tool
  ADD CONSTRAINT ToolFKUserIDCreator
  FOREIGN KEY    (UserIDCreator)
    REFERENCES   User(UserID)
    ON DELETE    SET NULL;

ALTER TABLE      Recipe
  ADD CONSTRAINT RecipeFKUserIDCreator
  FOREIGN KEY    (UserIDCreator)
    REFERENCES   User(UserID)
    ON DELETE    CASCADE;

ALTER TABLE      RecipeStep
  ADD CONSTRAINT RecipeStepFKUserIDCreator
  FOREIGN KEY    (UserIDCreator)
    REFERENCES   User(UserID)
    ON DELETE    CASCADE;

ALTER TABLE      RecipeStepIngredient
  ADD CONSTRAINT RecipeStepIngredientFKUserIDCreator
  FOREIGN KEY    (UserIDCreator)
    REFERENCES   User(UserID)
    ON DELETE    CASCADE;
    
-- Data
-- Ingredients
INSERT INTO Ingredient(Name)
  VALUES              ("Onion");
INSERT INTO Ingredient(Name)
  VALUES              ("Veal");
INSERT INTO Ingredient(Name)
  VALUES              ("Beef");
INSERT INTO Ingredient(Name)
  VALUES              ("Garlic");
INSERT INTO Ingredient(Name)
  VALUES              ("Tomato");
INSERT INTO Ingredient(Name)
  VALUES              ("Ginger (fresh)");
INSERT INTO Ingredient(Name)
  VALUES              ("Garam Masala");
INSERT INTO Ingredient(Name)
  VALUES              ("Cayenne Pepper");
INSERT INTO Ingredient(Name)
  VALUES              ("Sweet Pea");
INSERT INTO Ingredient(Name)
  VALUES              ("Lemon");
INSERT INTO Ingredient(Name)
  VALUES              ("Cilantro (fresh)");
INSERT INTO Ingredient(Name)
  VALUES              ("Ginger (dried)");
INSERT INTO Ingredient(Name)
  VALUES              ("Olive Oil");
INSERT INTO Ingredient(Name)
  VALUES              ("Cilantro (dried)");

-- Tools
INSERT INTO Tool(Name)
  VALUES        ("Knife");
INSERT INTO Tool(Name)
  VALUES        ("Large pan");
INSERT INTO Tool(Name)
  VALUES        ("Medium pan");
INSERT INTO Tool(Name)
  VALUES        ("Small pan");
INSERT INTO Tool(Name)
  VALUES        ("Large pot");
INSERT INTO Tool(Name)
  VALUES        ("Medium pot");
INSERT INTO Tool(Name)
  VALUES        ("Small pot");

-- Cuisine
INSERT INTO Cuisine
  VALUES           ("Middle-Eastern");
INSERT INTO Cuisine
  VALUES           ("Indian");
  
-- Measurement
INSERT INTO Measurement
  VALUES               ("Small");
INSERT INTO Measurement
  VALUES               ("Medium");
INSERT INTO Measurement
  VALUES               ("Large");
INSERT INTO Measurement
  VALUES	       ("Pound");
INSERT INTO Measurement
  VALUES               ("Ounce");
INSERT INTO Measurement
  VALUES               ("Tablespoon");
INSERT INTO Measurement
  VALUES               ("Teaspoon");
INSERT INTO Measurement
  VALUES	       ("Can");
INSERT INTO Measurement
  VALUES	       ("Package");
INSERT INTO Measurement
  VALUES	       ("Coat pan");
INSERT INTO Measurement
  VALUES	       ("Clove");

-- Preparation
INSERT INTO Preparation
  VALUES               ("Diced");
INSERT INTO Preparation
  VALUES               ("Chopped");
INSERT INTO Preparation
  VALUES               ("Finely Chopped");
INSERT INTO Preparation
  VALUES               ("Pured");
INSERT INTO Preparation
  VALUES               ("Minced");
INSERT INTO Preparation
  VALUES               ("Cubed (1 inch)");
INSERT INTO Preparation
  VALUES               ("Whole");
INSERT INTO Preparation
  VALUES               ("Ground");
INSERT INTO Preparation
  VALUES               ("Heaping");
INSERT INTO Preparation
  VALUES               ("Squeezed");

-- Recipes
-- Keema
INSERT INTO Recipe(Name, CuisineID, CookingTime)
  VALUES          ("Keema", "Middle-Eastern", "01:00:00");
--   Saute onion
INSERT INTO RecipeStep(RecipeID, Step, Instructions, ToolID)
  VALUES ((SELECT  RecipeID
	     FROM  Recipe
	     WHERE Name = 'Keema'
          ), 1, 
          "Saute onion in olive oil in large pan, about 5 minutes over medium heat.", 
          (SELECT  ToolID
             FROM  Tool
             WHERE Name = 'Large pan'
          )
         );
INSERT INTO RecipeStepIngredient(RecipeID, StepID, IngredientID, Amount, MeasurementID, PreparationID)
  VALUES ((SELECT  RecipeID
	     FROM  Recipe
	     WHERE Name = 'Keema'
          ), 1, 
          (SELECT  IngredientID
             FROM  Ingredient
             WHERE Name = 'Olive Oil'
          ),
          2, 
          "Tablespoon",
          NULL
         );
INSERT INTO RecipeStepIngredient(RecipeID, StepID, IngredientID, Amount, MeasurementID, PreparationID)
  VALUES ((SELECT  RecipeID
	     FROM  Recipe
	     WHERE Name = 'Keema'
          ), 1, 
          (SELECT  IngredientID
             FROM  Ingredient
             WHERE Name = 'Onion'
          ),
          1, 
          "Small",
          "Diced"
         );
--    Brown beef and veal
INSERT INTO RecipeStep(RecipeID, Step, Instructions, ToolID)
  VALUES ((SELECT  RecipeID
	     FROM  Recipe
	     WHERE Name = 'Keema'
          ), 2, 
          "Add veal and beef - brown", 
          (SELECT  ToolID
             FROM  Tool
             WHERE Name = 'Large pan'
          )
         );
INSERT INTO RecipeStepIngredient(RecipeID, StepID, IngredientID, Amount, MeasurementID, PreparationID)
  VALUES ((SELECT  RecipeID
	     FROM  Recipe
	     WHERE Name = 'Keema'
          ), 2, 
          (SELECT  IngredientID
             FROM  Ingredient
             WHERE Name = 'Beef'
          ),
          0.5, 
          "Pound",
          "Ground"
         );
INSERT INTO RecipeStepIngredient(RecipeID, StepID, IngredientID, Amount, MeasurementID, PreparationID)
  VALUES ((SELECT  RecipeID
	     FROM  Recipe
	     WHERE Name = 'Keema'
          ), 2, 
          (SELECT  IngredientID
             FROM  Ingredient
             WHERE Name = 'Veal'
          ),
          0.5, 
          "Pound",
          "Ground"
         );
--    Add vegetables
INSERT INTO RecipeStep(RecipeID, Step, Instructions, ToolID)
  VALUES ((SELECT  RecipeID
	     FROM  Recipe
	     WHERE Name = 'Keema'
          ), 3, 
          "Add garlic, tomatoes, ginger, garam masala, and cayenne pepper - cook for a couple of minutes over medium heat", 
          (SELECT  ToolID
             FROM  Tool
             WHERE Name = 'Large pan'
          )
         );
INSERT INTO RecipeStepIngredient(RecipeID, StepID, IngredientID, Amount, MeasurementID, PreparationID)
  VALUES ((SELECT  RecipeID
	     FROM  Recipe
	     WHERE Name = 'Keema'
          ), 3, 
          (SELECT  IngredientID
             FROM  Ingredient
             WHERE Name = 'Garlic'
          ),
          3, 
          "Clove",
          "Finely Chopped"
         );
INSERT INTO RecipeStepIngredient(RecipeID, StepID, IngredientID, Amount, MeasurementID, PreparationID)
  VALUES ((SELECT  RecipeID
	     FROM  Recipe
	     WHERE Name = 'Keema'
          ), 3, 
          (SELECT  IngredientID
             FROM  Ingredient
             WHERE Name = 'Tomato'
          ),
          2, 
          "Large",
          "Diced"
         );
INSERT INTO RecipeStepIngredient(RecipeID, StepID, IngredientID, Amount, MeasurementID, PreparationID)
  VALUES ((SELECT  RecipeID
	     FROM  Recipe
	     WHERE Name = 'Keema'
          ), 3, 
          (SELECT  IngredientID
             FROM  Ingredient
             WHERE Name = 'Ginger (fresh)'
          ),
          1, 
          "Tablespoon",
          NULL
         );
INSERT INTO RecipeStepIngredient(RecipeID, StepID, IngredientID, Amount, MeasurementID, PreparationID)
  VALUES ((SELECT  RecipeID
	     FROM  Recipe
	     WHERE Name = 'Keema'
          ), 3, 
          (SELECT  IngredientID
             FROM  Ingredient
             WHERE Name = 'Garam Masala'
          ),
          1, 
          "Teaspoon",
          "Heaping"
         );
INSERT INTO RecipeStepIngredient(RecipeID, StepID, IngredientID, Amount, MeasurementID, PreparationID)
  VALUES ((SELECT  RecipeID
	     FROM  Recipe
	     WHERE Name = 'Keema'
          ), 3, 
          (SELECT  IngredientID
             FROM  Ingredient
             WHERE Name = 'Cayenne Pepper'
          ),
          0.125, 
          "Teaspoon",
          NULL
         );
--    Simmer peas
INSERT INTO RecipeStep(RecipeID, Step, Instructions, ToolID)
  VALUES ((SELECT  RecipeID
	     FROM  Recipe
	     WHERE Name = 'Keema'
          ), 4, 
          "Add peas - cook 10 minutes (hard simmer)", 
          (SELECT  ToolID
             FROM  Tool
             WHERE Name = 'Large pan'
          )
         );
INSERT INTO RecipeStepIngredient(RecipeID, StepID, IngredientID, Amount, MeasurementID, PreparationID)
  VALUES ((SELECT  RecipeID
	     FROM  Recipe
	     WHERE Name = 'Keema'
          ), 4, 
          (SELECT  IngredientID
             FROM  Ingredient
             WHERE Name = 'Sweet Pea'
          ),
          1, 
          "Can",
          NULL
         );
--   Remove from heat, add final ingredients
INSERT INTO RecipeStep(RecipeID, Step, Instructions, ToolID)
  VALUES ((SELECT  RecipeID
	     FROM  Recipe
	     WHERE Name = 'Keema'
          ), 5, 
          "Add lemon and cilantro. Remove from heat.", 
          (SELECT  ToolID
             FROM  Tool
             WHERE Name = 'Large pan'
          )
         );
INSERT INTO RecipeStepIngredient(RecipeID, StepID, IngredientID, Amount, MeasurementID, PreparationID)
  VALUES ((SELECT  RecipeID
	     FROM  Recipe
	     WHERE Name = 'Keema'
          ), 1, 
          (SELECT  IngredientID
             FROM  Ingredient
             WHERE Name = 'Lemon'
          ),
          1, 
          "Small",
          "Squeezed"
         );
INSERT INTO RecipeStepIngredient(RecipeID, StepID, IngredientID, Amount, MeasurementID, PreparationID)
  VALUES ((SELECT  RecipeID
	     FROM  Recipe
	     WHERE Name = 'Keema'
          ), 1, 
          (SELECT  IngredientID
             FROM  Ingredient
             WHERE Name = 'Cilantro (fresh)'
          ),
          2, 
          "Tablespoon",
          "Finely Chopped"
         );
--   Serve
INSERT INTO RecipeStep(RecipeID, Step, Instructions, ToolID)
  VALUES ((SELECT  RecipeID
	     FROM  Recipe
	     WHERE Name = 'Keema'
          ), 6, 
          "Serve over spagetthi or on tortillas.", 
          NULL
         );
         
-- Updates
-- Lab 11
-- Add Username and Joindate to User
ALTER TABLE  User
  ADD COLUMN UserName VARCHAR(20) NOT NULL UNIQUE;
ALTER TABLE  User
  ADD COLUMN JoinDate DATETIME NOT NULL;

-- Extra space for mcrypt function
ALTER TABLE User
  MODIFY COLUMN Password VARCHAR(32);

-- New cuisines
INSERT INTO Cuisine
  VALUES('Greek');
INSERT INTO Cuisine
  VALUES('TexMex');
INSERT INTO Cuisine
  VALUES('Russian');
INSERT INTO Cuisine
  VALUES('African');
INSERT INTO Cuisine
  VALUES('Jewish');
INSERT INTO Cuisine
  VALUES('Vegetarian');
INSERT INTO Cuisine
  VALUES('Vegan');

-- Allergn table, instead of associating directly with ingredients
CREATE TABLE Allergn (
	AllergnID		INT			AUTO_INCREMENT PRIMARY KEY,
	Name			VARCHAR(30)		NOT NULL,
	Description		VARCHAR(100)
);

-- Bridge table, multiple users have multiple allergns
CREATE TABLE UserAllergn (
	UserID			INT,
	AllergnID		INT,
	Degree			TINYINT UNSIGNED,
	PRIMARY KEY(UserID, AllergnID)
);
ALTER TABLE	 UserAllergn
  ADD CONSTRAINT UserAllergnFKUserID
  FOREIGN KEY    (UserID)
  REFERENCES     User(UserID)
  ON DELETE      CASCADE;
ALTER TABLE	 UserAllergn
  ADD CONSTRAINT UserAllergnFKAllergnID
  FOREIGN KEY    (AllergnID)
  REFERENCES     Allergn(AllergnID);
  
-- Bridge table, multiple recipes have multiple allergns
CREATE TABLE RecipeAllergn (
	RecipeID		INT,
	AllergnID		INT,
	Degree			TINYINT UNSIGNED,
	PRIMARY KEY(RecipeID, AllergnID)
);
ALTER TABLE	 RecipeAllergn
  ADD CONSTRAINT RecipeAllergnFKRecipeID
  FOREIGN KEY    (RecipeID)
  REFERENCES     Recipe(RecipeID)
  ON DELETE      CASCADE;
ALTER TABLE	 RecipeAllergn
  ADD CONSTRAINT RecipeAllergnFKAllergnID
  FOREIGN KEY    (AllergnID)
  REFERENCES     Allergn(AllergnID);
  
-- Bridge table, multiple recipes have multiple cuisine types
CREATE TABLE RecipeCuisine (
	RecipeID		INT,
	CuisineID		VARCHAR(20),
	PRIMARY KEY(RecipeID, CuisineID)
);
ALTER TABLE	 RecipeCuisine
  ADD CONSTRAINT RecipeCuisineFKRecipeID
  FOREIGN KEY    (RecipeID)
  REFERENCES     Recipe(RecipeID)
  ON DELETE      CASCADE;
ALTER TABLE	 RecipeCuisine
  ADD CONSTRAINT RecipeCuisineFKCuisineID
  FOREIGN KEY    (CuisineID)
  REFERENCES     Cuisine(CuisineName)
  ON DELETE      CASCADE;
ALTER TABLE        Recipe
  DROP FOREIGN KEY RecipeFKCuisineID;
ALTER TABLE       Recipe
  DROP COLUMN     CuisineID;

-- Connect Keema to Indian cuisine 
INSERT INTO RecipeCuisine
  VALUES(1, 'Indian');

-- New allergns
INSERT INTO Allergn(Name, Description)
  VALUES('Wheat', 'Wheat can be found in many products including condiments like soy sauce and ketchup.');
INSERT INTO Allergn(Name, Description)
  VALUES('Nuts', 'Many factories also process nuts, especially candy producers, so always check the label.');
INSERT INTO Allergn(Name, Description)
  VALUES('Citrus', 'Citrus allergies can be triggered by lemon, orange, grapefruit, or pineapple.');

-- Connect Keema to citrus allergn
INSERT INTO RecipeAllergn(RecipeID, AllergnID)
  VALUES(1, 3);

-- Current
/* Rename BrandName to Name */
ALTER TABLE Brand
  CHANGE    BrandName Name VARCHAR(20);

/* Add description to Recipe */
ALTER TABLE  Recipe
  ADD COLUMN Description TINYTEXT;
/* Add preparationInstructions to Recipe */
ALTER TABLE  Recipe
  ADD COLUMN PreparationInstructions TINYTEXT;
/* Add unfinished for recipe */
ALTER TABLE  Recipe
  ADD COLUMN Unfinished BIT(1) DEFAULT 1;

/* Add Time to RecipeStep */
ALTER TABLE  RecipeStep
  ADD COLUMN CookingTime Time;
/* Change Step in RecipeStep to StepID */
ALTER TABLE RecipeStepIngredient
  DROP FOREIGN KEY RecipeStepIngredientFKRecipeStep
ALTER TABLE RecipeStepTool
  DROP FOREIGN KEY RecipeStepToolFKRecipeStep
ALTER TABLE RecipeStep
  DROP FOREIGN KEY RecipeStepFKRecipeID;
ALTER TABLE RecipeStep
  DROP PRIMARY KEY;
ALTER TABLE RecipeStep
  CHANGE    Step StepID TINYINT(3) UNSIGNED;
ALTER TABLE RecipeStep
  ADD PRIMARY KEY(RecipeID, StepID);
ALTER TABLE      RecipeStep
  ADD CONSTRAINT RecipeStepFKRecipeID
  FOREIGN KEY    (RecipeID)
    REFERENCES   Recipe(RecipeID)
    ON DELETE    CASCADE;
ALTER TABLE      RecipeStepIngredient
  ADD CONSTRAINT RecipeStepIngredientFKRecipeStep
  FOREIGN KEY    (RecipeID, StepID)
    REFERENCES   RecipeStep(RecipeID, StepID)
    ON DELETE    CASCADE
    ON UPDATE    CASCADE;
ALTER TABLE      RecipeStepTool
  ADD CONSTRAINT RecipeStepToolFKRecipeStep
  FOREIGN KEY    (RecipeID, StepID)
    REFERENCES   RecipeStep(RecipeID, StepID)
    ON DELETE    CASCADE
    ON UPDATE    CASCADE;

/* Create RecipeStepTool */
ALTER TABLE RecipeStep
  DROP FOREIGN KEY RecipeStepFKToolID;
ALTER TABLE RecipeStep
  DROP COLUMN ToolID;
CREATE TABLE RecipeStepTool (
	RecipeID		INT,
	StepID			TINYINT UNSIGNED,
	ToolID			INT,
	Amount			FLOAT,
	PreferredBrand		INT,
	UserIDCreator		INT,
	PRIMARY KEY(RecipeID, StepID, ToolID)
);
ALTER TABLE      RecipeStepTool
  ADD CONSTRAINT RecipeStepToolFKRecipeStep
  FOREIGN KEY    (RecipeID, StepID)
    REFERENCES   RecipeStep(RecipeID, Step)
    ON DELETE    CASCADE
    ON UPDATE    CASCADE;
ALTER TABLE      RecipeStepTool
  ADD CONSTRAINT RecipeStepToolFKToolID
  FOREIGN KEY    (ToolID)
    REFERENCES   Tool(ToolID)
    ON DELETE    CASCADE;

/* Remove ZipCode from User */
ALTER TABLE User
  DROP COLUMN ZipCode;
/* Remove UserIngredients table */
DROP TABLE UserIngredientInfo;
/* Add PreferredBrand to Pantry */
ALTER TABLE PantryInventory
  ADD COLUMN BrandIDPreffered INT;

/* Add description to tool */
ALTER TABLE Tool
  ADD COLUMN Description TINYTEXT;

/* Remove Creator from tables - not as straight-forward as I thought 
     Recipe, RecipeStep, RecipeStepIngredient, Tool, Ingredient 
     Cuisine, Measurement, Preparation too? 
   No, not now, just ignore the field */
     
