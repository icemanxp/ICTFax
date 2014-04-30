CREATE OR REPLACE ALGORITHM = MERGE VIEW v_field_data_field_givenname AS
SELECT users.uid AS ictpbx_user_id,
field_data_field_givenname.field_givenname_value AS first_name
FROM users LEFT JOIN field_data_field_givenname
ON users.uid = field_data_field_givenname.entity_id;

CREATE OR REPLACE ALGORITHM = MERGE VIEW v_field_data_field_sn AS
SELECT users.uid AS ictpbx_user_id,
field_data_field_sn.field_sn_value AS last_name
FROM users LEFT JOIN (field_data_field_sn)
ON(users.uid = field_data_field_sn.entity_id);

CREATE OR REPLACE ALGORITHM = MERGE VIEW v_field_data_field_telephonenumber AS
SELECT users.uid AS ictpbx_user_id,
field_data_field_telephonenumber.field_telephonenumber_value AS phone_number
FROM users LEFT JOIN (field_data_field_telephonenumber)
ON(users.uid = field_data_field_telephonenumber.entity_id);

CREATE OR REPLACE ALGORITHM = MERGE VIEW v_field_data_field_mobile AS
SELECT users.uid AS ictpbx_user_id,
field_data_field_mobile.field_mobile_value AS mobile_number
FROM users LEFT JOIN (field_data_field_mobile)
ON(users.uid = field_data_field_mobile.entity_id);

CREATE OR REPLACE ALGORITHM = MERGE VIEW v_field_data_field_facsimiletelephonenumber AS
SELECT users.uid AS ictpbx_user_id,
field_data_field_facsimiletelephonenumber.field_facsimiletelephonenumber_value AS fax_number
FROM users LEFT JOIN (field_data_field_facsimiletelephonenumber)
ON(users.uid = field_data_field_facsimiletelephonenumber.entity_id);

CREATE OR REPLACE ALGORITHM = MERGE VIEW v_field_data_field_address AS
SELECT users.uid AS ictpbx_user_id,
CONCAT(field_data_field_streetaddress.field_streetaddress_value,'\n\r',
field_data_field_l.field_l_value,', ',
field_data_field_st.field_st_value,', ',
field_data_field_c.field_c_value,"\n\r",
field_data_field_postalcode.field_postalcode_value) AS address
FROM users LEFT JOIN (field_data_field_postalcode, field_data_field_l, field_data_field_st, field_data_field_streetaddress, field_data_field_c)
ON(users.uid = field_data_field_postalcode.entity_id &&
	users.uid = field_data_field_l.entity_id &&
	users.uid = field_data_field_st.entity_id &&
	users.uid = field_data_field_streetaddress.entity_id &&
	users.uid = field_data_field_c.entity_id);

CREATE OR REPLACE ALGORITHM = MERGE VIEW v_field_data_field_c AS
SELECT users.uid AS ictpbx_user_id,
field_data_field_c.field_c_value AS country
FROM users LEFT JOIN (field_data_field_c)
ON(users.uid = field_data_field_c.entity_id);

CREATE OR REPLACE ALGORITHM = MERGE VIEW v_field_data_field_company AS
SELECT users.uid AS ictpbx_user_id,
field_data_field_company.field_company_value AS company
FROM users LEFT JOIN (field_data_field_company)
ON(users.uid = field_data_field_company.entity_id);

CREATE OR REPLACE ALGORITHM = MERGE VIEW v_field_data_field_wwwhomepage AS
SELECT users.uid AS ictpbx_user_id,
field_data_field_wwwhomepage.field_wwwhomepage_value AS website
FROM users LEFT JOIN (field_data_field_wwwhomepage)
ON(users.uid = field_data_field_wwwhomepage.entity_id);

DROP TABLE ictfax.ictpbx_user;

CREATE OR REPLACE VIEW ictfax.ictpbx_user AS 
SELECT 
users.uid AS ictpbx_user_id,
users.name AS name,
v_field_data_field_givenname.first_name AS first_name,
v_field_data_field_sn.last_name AS last_name,
users.mail AS mail,
v_field_data_field_telephonenumber.phone_number AS phone_number,
v_field_data_field_mobile.mobile_number AS mobile_number,
v_field_data_field_facsimiletelephonenumber.fax_number AS fax_number,
v_field_data_field_address.address AS address,
v_field_data_field_c.country AS country,
v_field_data_field_company.company AS company,
v_field_data_field_wwwhomepage.website AS website,
users.uid AS uid,
CASE users.uid
WHEN users.uid = 1 THEN '1'
ELSE '0'
END AS active,
null AS credit,
null AS free_bundle,
null AS reserve_free_bundle,
null AS package

FROM users JOIN (v_field_data_field_givenname, v_field_data_field_sn, v_field_data_field_telephonenumber, v_field_data_field_mobile, v_field_data_field_facsimiletelephonenumber, v_field_data_field_c, v_field_data_field_wwwhomepage, v_field_data_field_company, v_field_data_field_address)
	ON(users.uid = v_field_data_field_givenname.ictpbx_user_id &&
	users.uid = v_field_data_field_sn.ictpbx_user_id &&
	users.uid = v_field_data_field_telephonenumber.ictpbx_user_id &&
	users.uid = v_field_data_field_mobile.ictpbx_user_id &&
	users.uid = v_field_data_field_facsimiletelephonenumber.ictpbx_user_id &&
	users.uid = v_field_data_field_address.ictpbx_user_id &&
	users.uid = v_field_data_field_c.ictpbx_user_id &&
	users.uid = v_field_data_field_wwwhomepage.ictpbx_user_id &&
	users.uid = v_field_data_field_company.ictpbx_user_id);