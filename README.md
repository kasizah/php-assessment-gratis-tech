# PHP assessment for Gratis Tech Solutions
## Status/Notes:
- current, but not final version of project
- [longofathens.php](https://github.com/the-wt-ahmadi/php-assessment-gratis-tech/blob/main/longofathens.php) creates a bunch of PHP files because I couldn't figure out how to simply link to different parts of a file.
- may have overestimated my ability, some of this is *only slightly* beyond me. With outside help I could likely get it done (currently struggling).
  - Few things I was most certainly not taught about MySQL databases in CPSC 3220 (primary source of MySQL and PHP knowledge).
## Current Issues:
- Database is created, but [new_listing.php](https://github.com/the-wt-ahmadi/php-assessment-gratis-tech/blob/main/new_listing.php) file not adding data to tables in `listings` database.
  - Issue might possibly be here (lines 190-195):
    ```
    // get car info from MySQL database
    $stmt = $mysqli->prepare("SELECT CONCAT(\'2022 \',make,\' \',model,\' \',vehicle_trim) as vehicle,engine,transmission,drive_type,interior,exterior
                              FROM car,p_d_train,car_color WHERE car.car_id='.$i.' AND p_d_train.p_d_train_id=car.car_id AND car_color.car_color_id=car.car_id;");
    $stmt->execute(); // submit query to DB
    $result = $stmt->get_result(); // get the results
    // if($result->num_rows === 0) exit(\'No rows\');
    ```
  - Lines 137-186 not adding to tables (as previously stated above)
