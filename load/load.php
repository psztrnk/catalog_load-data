<?php
    // including Kirby Toolkit
    require ('../toolkit/bootstrap.php');
    // including Database Connection
    require ('../config/config.php');

    $db = new Database(array(
    'type' => 'mysql',
    'host' => $hostname,
    'database' => $database,
    'user' => $username,
    'password' => $password
));

    for ($i=1; $i<=10000;$i++) {

        $firstname = explode(',',file_get_contents('firstnames.txt'))[rand(0,28)];
        $lastname = explode(',',file_get_contents('lastnames.txt'))[rand(0,99)];
        $title_1 = explode(',',file_get_contents('commonwords.txt'))[rand(0,299)];
        $title_2 = explode(',',file_get_contents('commonwords.txt'))[rand(0,299)];
        $title_3 = explode(',',file_get_contents('commonwords.txt'))[rand(0,299)];
        $title_4 = explode(',',file_get_contents('lastnames.txt'))[rand(0,99)];
        $title_5 = explode(',',file_get_contents('commonwords.txt'))[rand(0,299)];
        $publisher_1 = explode(',',file_get_contents('lastnames.txt'))[rand(0,99)];
        $publisher_2 = explode(',',file_get_contents('lastnames.txt'))[rand(0,99)];
        $year = explode(',',file_get_contents('years.txt'))[rand(0,38)];
        $genre_1 = explode(',',file_get_contents('genres.txt'))[rand(0,73)];
        $genre_2 = explode(',',file_get_contents('genres.txt'))[rand(0,73)];
        $isbn = explode(',',file_get_contents('isbns.txt'))[rand(0,39)];
        $cover = explode(',',file_get_contents('covers.txt'))[rand(0,7)];

        $f_contents = file("random.txt"); 
        $description_1 = $f_contents[rand(0, count($f_contents) - 1)];
        $description_2 = $f_contents[rand(0, count($f_contents) - 1)];
        $description_3 = $f_contents[rand(0, count($f_contents) - 1)];
        $description_4 = $f_contents[rand(0, count($f_contents) - 1)];

        $collection = $db->table('books');
        if ($id = $collection->insert(array(
            'title' => ucfirst($title_1).' '.ucfirst($title_2).' '.ucfirst($title_3).' '.ucfirst($title_4).' '.ucfirst($title_5),
            'isbn' => $isbn,
            'publisher' => $publisher_1.' '.$publisher_2,
            'year' => $year,
            'description' => $description_1.' '.$description_2.' '.$description_3.' '.$description_4,
            'imgpath' => $cover,
            'a_str' => $lastname.', '.$firstname,
            'g_str' => $genre_1.', '.$genre_2,
            'owner' => '1',
        
            ))) {
                
                $bookid = $id;
            }

            $author_collection = $db->table('authors');
            
            $id = $author_collection->insert(array(
                    'author' => $lastname.', '.$firstname,
                    'book_id' => $bookid
                ));

            $genre_collection = $db->table('genres');
            $id = $genre_collection->insert(array(
                    'genre' => $genre_1,
                    'book_id' => $bookid
                ));

            $id2 = $genre_collection->insert(array(
                    'genre' => $genre_2,
                    'book_id' => $bookid
                ));

        echo $i.'. record added.<br />';

    }
    
?>
