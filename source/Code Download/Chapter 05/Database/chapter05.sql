s

-- Create catalog_get_products_in_category stored procedure
CREATE PROCEDURE catalog_get_products_in_category(
  IN inCategoryId INT, IN inShortProductDescriptionLength INT,
  IN inProductsPerPage INT, IN inStartItem INT)
BEGIN
  -- Prepare statement
  PREPARE statement FROM
   "SELECT     p.product_id, p.name,
               IF(LENGTH(p.description) <= ?,
                  p.description,
                  CONCAT(LEFT(p.description, ?),
                         '...')) AS description,
               p.price, p.discounted_price, p.thumbnail
    FROM       product p
    INNER JOIN product_category pc
                 ON p.product_id = pc.product_id
    WHERE      pc.category_id = ?
    ORDER BY   p.display DESC
    LIMIT      ?, ?";

  -- Define query parameters
  SET @p1 = inShortProductDescriptionLength; 
  SET @p2 = inShortProductDescriptionLength; 
  SET @p3 = inCategoryId;
  SET @p4 = inStartItem; 
  SET @p5 = inProductsPerPage; 

  -- Execute the statement
  EXECUTE statement USING @p1, @p2, @p3, @p4, @p5;
END$$

-- Create catalog_count_products_on_department stored procedure
CREATE PROCEDURE catalog_count_products_on_department(IN inDepartmentId INT)
BEGIN
  SELECT DISTINCT COUNT(*) AS products_on_department_count
  FROM            product p
  INNER JOIN      product_category pc
                    ON p.product_id = pc.product_id
  INNER JOIN      category c
                    ON pc.category_id = c.category_id
  WHERE           (p.display = 2 OR p.display = 3)
                  AND c.department_id = inDepartmentId;
END$$

-- Create catalog_get_products_on_department stored procedure
CREATE PROCEDURE catalog_get_products_on_department(
  IN inDepartmentId INT, IN inShortProductDescriptionLength INT,
  IN inProductsPerPage INT, IN inStartItem INT)
BEGIN
  PREPARE statement FROM
    "SELECT DISTINCT p.product_id, p.name,
                     IF(LENGTH(p.description) <= ?,
                        p.description,
                        CONCAT(LEFT(p.description, ?),
                               '...')) AS description,
                     p.price, p.discounted_price, p.thumbnail
     FROM            product p
     INNER JOIN      product_category pc
                       ON p.product_id = pc.product_id
     INNER JOIN      category c
                       ON pc.category_id = c.category_id
     WHERE           (p.display = 2 OR p.display = 3)
                     AND c.department_id = ?
     ORDER BY        p.display DESC
     LIMIT           ?, ?";

  SET @p1 = inShortProductDescriptionLength;
  SET @p2 = inShortProductDescriptionLength;
  SET @p3 = inDepartmentId;
  SET @p4 = inStartItem;
  SET @p5 = inProductsPerPage;

  EXECUTE statement USING @p1, @p2, @p3, @p4, @p5;
END$$

-- Create catalog_count_products_on_catalog stored procedure
CREATE PROCEDURE catalog_count_products_on_catalog()
BEGIN
  SELECT COUNT(*) AS products_on_catalog_count
  FROM   product
  WHERE  display = 1 OR display = 3;
END$$

-- Create catalog_get_products_on_catalog stored procedure
CREATE PROCEDURE catalog_get_products_on_catalog(
  IN inShortProductDescriptionLength INT,
  IN inProductsPerPage INT, IN inStartItem INT)
BEGIN
  PREPARE statement FROM
    "SELECT   product_id, name,
              IF(LENGTH(description) <= ?,
                 description,
                 CONCAT(LEFT(description, ?),
                        '...')) AS description,
              price, discounted_price, thumbnail
     FROM     product
     WHERE    display = 1 OR display = 3
     ORDER BY display DESC
     LIMIT    ?, ?";

  SET @p1 = inShortProductDescriptionLength;
  SET @p2 = inShortProductDescriptionLength;
  SET @p3 = inStartItem;
  SET @p4 = inProductsPerPage;

  EXECUTE statement USING @p1, @p2, @p3, @p4;
END$$

-- Create catalog_get_product_details stored procedure
CREATE PROCEDURE catalog_get_product_details(IN inProductId INT)
BEGIN
  SELECT product_id, name, description,
         price, discounted_price, image, image_2
  FROM   product
  WHERE  product_id = inProductId;
END$$

-- Create catalog_get_product_locations stored procedure
CREATE PROCEDURE catalog_get_product_locations(IN inProductId INT)
BEGIN
  SELECT c.category_id, c.name AS category_name, c.department_id,
         (SELECT name
          FROM   department
          WHERE  department_id = c.department_id) AS department_name
          -- Subquery returns the name of the department of the category
  FROM   category c
  WHERE  c.category_id IN
           (SELECT category_id
            FROM   product_category
            WHERE  product_id = inProductId);
            -- Subquery returns the category IDs a product belongs to
END$$

-- Change back the DELIMITER to ;
DELIMITER ;
