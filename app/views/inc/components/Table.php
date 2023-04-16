<?php

namespace app\views\inc\components;

class Table
{
    public function __construct(
        private string $activeLink,
        private array $tableHeaders,
        private array $tableData,
        private string $primaryKey = "id",
        private string $noContentMessage = "No data available",
        private array $actionLabels = ["Edit", "Delete"],
        private array $actionUrls = ["edit", "delete"],
    ) {
    }

    public function render(): void
    {
        $html = "<table>";
        $html .= "<thead>";
        $html .= "<tr class='row'>";
        foreach ($this->tableHeaders as $key => $value) {
            $html .= "<th class='" . $value["class"] . "'>" . $value["label"] . "</th>";
        }
        $html .= "</tr>";
        $html .= "</thead>";
        $html .= "<tbody>";
        if (count($this->tableData) > 0) {
            foreach ($this->tableData as $row) {
                $html .= "<tr class='row'>";
                foreach ($this->tableHeaders as $key => $value) {
                    if (property_exists($row, $key)) {
                        $html .= "<td class='" . $this->tableHeaders[$key]["class"] . "'>" . $row->$key . "</td>";
                    } else {
                        if ($key == "actions") {
                            $editUrl = URL_ROOT . "/" . $this->activeLink . "/" . $this->actionUrls[0] . "/" . $row->{$this->primaryKey};
                            $deleteUrl = URL_ROOT . "/" . $this->activeLink . "/" . $this->actionUrls[1] . "/" . $row->{$this->primaryKey};

                            $html .= "<td class='" . $this->tableHeaders[$key]["class"] . "'>
                                        <div class='row justify-content-center align-items-center gap-1'>
                                            
                                        </div>
                                  </td>";
                        } else {
                            $html .= "<td class='" . $this->tableHeaders[$key]["class"] . "'></td>";
                        }
                    }
                }
                $html .= "</tr>";
            }
        } else {
            $html .= "<tr class='no-content'><td class='col-12 text-center py-4'>" .
                $this->noContentMessage . "</td></tr>";
        }
        $html .= "</tbody>";
        if (count($this->tableData) > 0) {
            $html .= "<tfoot>";
            $html .= "<tr class='row justify-content-end pagination'>";
            $html .= "<td class='col-3 text-right'><span>Rows per page:</span>
                                            <label>
                                                <select name='table_filter' id='table_filter'>
                                                    <option value=''>" . count($this->tableData) . "</option>";
            $html .= "</select></label></td>";
            $html .= "<td class='col-2'>1-" . count($this->tableData) . " of " . count($this->tableData);
            $html .= "</td></tr>";
            $html .= "</tfoot>";
        }

        $html .= "</table>";
        echo $html;
    }
}
