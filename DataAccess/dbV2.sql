
ALTER TABLE item DROP PRIMARY KEY;
ALTER TABLE item MODIFY COLUMN itmNo INT;
ALTER TABLE item AUTO_INCREMENT = 1000;
ALTER TABLE item ADD PRIMARY KEY (itmNo);

ALTER TABLE popitem
RENAME TO poplines;

-- POP primary key change
ALTER TABLE pop MODIFY COLUMN popNo INT primary key auto_increment;
ALTER TABLE pop AUTO_INCREMENT = 3000;

-- POPLine table change
ALTER TABLE poplines MODIFY COLUMN popNo INT ;
ALTER TABLE poplines MODIFY COLUMN itmNo INT ;

-- Purchase Order primary key change
ALTER TABLE purchaseorder DROP PRIMARY KEY;
ALTER TABLE purchaseorder MODIFY COLUMN poNo INT primary key auto_increment;
ALTER TABLE purchaseorder AUTO_INCREMENT = 4000;
ALTER TABLE purchaseorder MODIFY COLUMN popNo INT;

-- POLine table change
ALTER TABLE polines MODIFY COLUMN poNo INT primary key auto_increment;

-- Sales rep primary key change
ALTER TABLE sales_rep MODIFY COLUMN saleRepNo INT primary key auto_increment;
ALTER TABLE sales_rep AUTO_INCREMENT = 8000;

-- Supplier primary key change
ALTER TABLE supplier DROP PRIMARY KEY;
ALTER TABLE supplier MODIFY COLUMN supId INT primary key auto_increment;
ALTER TABLE supplier AUTO_INCREMENT = 9000;

-- Allocation rejection auto increment
ALTER TABLE rejection AUTO_INCREMENT = 5000;
ALTER TABLE allocation AUTO_INCREMENT = 6000;

-- Allocation rejection auto increment
ALTER TABLE inventory MODIFY COLUMN poLineId INT;
ALTER TABLE inventory MODIFY COLUMN poNumber INT;
ALTER TABLE inventory MODIFY COLUMN itemNo INT;

--Foreign Key allocation
-- Foreign Key adding to purchaseorderTable
ALTER TABLE purchaseorder
ADD CONSTRAINT fk_popNo
FOREIGN KEY (popNo) REFERENCES pop(popNo);

-- Foreign Key adding to popLine
ALTER TABLE poplines
ADD CONSTRAINT fk_poplines_popNo
FOREIGN KEY (popNo) REFERENCES pop(popNo);

ALTER TABLE poplines
ADD CONSTRAINT fk_poplines_itmNo
FOREIGN KEY (itmNo) REFERENCES item(itmNo);

-- Foreign Key adding to poLine
ALTER TABLE polines
ADD CONSTRAINT fk_polines_popNo
FOREIGN KEY (popNo) REFERENCES pop(popNo);

ALTER TABLE polines
ADD CONSTRAINT fk_polines_poNo
FOREIGN KEY (poNo) REFERENCES purchaseorder(poNo);

ALTER TABLE polines
ADD CONSTRAINT fk_polines_itmNo
FOREIGN KEY (itmNo) REFERENCES item(itmNo);

-- Foreign Key adding to inventory
ALTER TABLE inventory
ADD CONSTRAINT fk_inventory_itmNo
FOREIGN KEY (itemNo) REFERENCES item(itmNo);

ALTER TABLE inventory
ADD CONSTRAINT fk_inventory_poNo
FOREIGN KEY (poNo) REFERENCES purchaseorder(popNo);

-- Foreign Key adding to allocation
ALTER TABLE allocation
ADD CONSTRAINT fk_allocation_itmNo
FOREIGN KEY (itmNo) REFERENCES item(itmNo);

ALTER TABLE allocation
ADD CONSTRAINT fk_allocation_salesrep
FOREIGN KEY (saleRepNo) REFERENCES sales_rep(saleRepNo);

-- Foreign Key adding to allocation
ALTER TABLE rejection
ADD CONSTRAINT fk_rejection_itmNo
FOREIGN KEY (itmNo) REFERENCES item(itmNo);

ALTER TABLE rejection
ADD CONSTRAINT fk_rejection_poNo
FOREIGN KEY (poNo) REFERENCES purchaseorder(poNo);

-- Drop the old foreign key constraint
ALTER TABLE inventory DROP FOREIGN KEY fk_inventory_poNo;

-- Add a new foreign key constraint
ALTER TABLE inventory
ADD CONSTRAINT fk_inventory_poNo FOREIGN KEY (poNo) REFERENCES purchaseorder (poNo);

ALTER TABLE item add column status varchar(40);



