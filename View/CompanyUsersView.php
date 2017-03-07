<?php
/**
 * Created by PhpStorm.
 * User: Grabe Grabe
 * Date: 8/10/2016
 * Time: 8:27 AM
 */

class CompanyUsersView {

    public function displayCompanyUsers($company, $system)
    {
        $count = 0;
        $output = ' ';
        foreach ($company as $row)
        {
            $password = $system->makeHash('decrypt', $row['pass']);

            $output .= '<tr>' . PHP_EOL;
            $output .= '<td>' . $row['company'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['user'] . '</td>' . PHP_EOL;
            $output .= '<td>' . $password . '</td>' . PHP_EOL;
            $output .= '<td>' . $row['version'] . '</td>' . PHP_EOL;
            $output .= '<td>' . date("m/d/Y", strtotime($row['date_added'])) . '</td>' . PHP_EOL;
            $output .= '<td>
                        <button class="btn btn-success btn-xs"
                        data-type="edit"
                        data-id="' . $row['cuid'] . '"
                        data-first-name="' . $row['company'] . '"
                        data-last-name="' . $row['user'] . '";
                        data-password="' . $password . '"
                        data-toggle="modal"
                        data-target="#modal_edit_user" onclick="pushData(this)"><i class="fa fa-edit"></i> Edit</button>

                        <button class="btn btn-danger btn-xs"
                        data-type="delete"
                        data-id="' . $row['cuid'] . '"
                        data-first-name="' . $row['company'] . '"
                        data-user="' . $row['user'] . '"
                        data-password="' . $row['pass'] . '"
                        data-toggle="modal"
                        data-target="#modal_delete_user" onclick="pushData(this)"><i class="fa fa-trash-o"></i> Delete</button>
                        </td>' . PHP_EOL;
            $output .= '</tr>' . PHP_EOL;

            $count++;

        }
        return $output;
    }

}