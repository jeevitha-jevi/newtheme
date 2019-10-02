<?php

class DelimitedFileReader{
    // This method reads the csv file content and returns the data as an array.
    // Each row of the file is read into an associative array. If the file has 
    // headers, the each row's data will be read into the associative array with
    // the header as a key.
    static function readFile($file, $hasFieldNames = false, $headerRow = 1, $delimiter = ','){
        $result = Array(); 
        $size = filesize($file) +1; 
        $rowCount = 1;
        error_log('The file size : '. $size);
        $fileHandle = fopen($file, 'r'); 
        #TO DO: There must be a better way of finding out the size of the longest row... until then 
        //error_log('The header : '.print_r($headers, true));
        while ($row = fgetcsv($fileHandle, $size, $delimiter)) { 
            $n = count($row); 
            if ($hasFieldNames && $headerRow == $rowCount) {
                $headers = $row;
            } else {
                $res=array(); 
                for($i = 0; $i < $n; $i++) { 
                    $idx = ($headers) ? $headers[$i] : $i; 
                    $res[$idx] = $row[$i]; 
                } 
                $result[] = $res;                 
            }          
            $rowCount++;
        } 
        fclose($fileHandle); 
        return $result;         
    }
}