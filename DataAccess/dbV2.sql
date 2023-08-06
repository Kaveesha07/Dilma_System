-- Step 2: Drop the existing primary key constraint if it exists
ALTER TABLE item DROP PRIMARY KEY;

-- Step 3: Change the data type of the itmNo column to INT
ALTER TABLE item MODIFY COLUMN itmNo INT;

-- Step 4: Set the auto-increment starting value to 1000
ALTER TABLE item AUTO_INCREMENT = 1000;

-- Step 5: Make the itmNo column the primary key and set it as auto-increment
ALTER TABLE item ADD PRIMARY KEY (itmNo);

ALTER TABLE popitem
RENAME TO poplines;