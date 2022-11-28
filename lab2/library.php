<?php
class TableRow
{
  public string $region;
  public float $population;
  public int $uni_number;
  public float $uni_per_hundren;

  public function __construct(string $region, float $population, int $uni_number)
  {
    $this->region = $region;
    $this->population = $population;
    $this->uni_number = $uni_number;
    $this->uni_per_hundren = round($uni_number / $population * 100, 2);
  }
}
function get_table_row(&$file)
{
  $region = fgets($file);
  $population = fgets($file);
  $uni_number = fgets($file);
  return new TableRow($region, $population, $uni_number);
}

function echo_html_table_rows(&$file_name)
{
  $file = fopen($file_name, "r");
  // The first line in the file is a number of rows.
  $number_of_rows = fgets($file);
  for ($i = 1; $i <= $number_of_rows; $i++) {
    $row = get_table_row($file);
    echo_html_table_row(
      $i,
      $row->region,
      $row->population,
      $row->uni_number,
      $row->uni_per_hundren
    );
  }

  fclose($file);
}

function echo_html_table_row($number, $region, $population, $uni_number, $uni_per_hundren)
{
  echo "<tr>
  <th scope=\"row\"> $number</th>
  <td>$region</td>
  <td>$population</td>
  <td>$uni_number</td>
  <td>$uni_per_hundren</td>
</tr>";
}
