<?php

namespace app\views\inc\components;

class Table
{
    public function __construct(
        private array $tableHeaders,
        private array $tableData,
        private string $primaryKey = "id",
        private string $noContentMessage = "No data available",
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
                            $html .= "<td class='" . $this->tableHeaders[$key]["class"] . "'>
                                        <div class='row justify-content-center align-items-center gap-1'>
                                            <div class='col'>
                                                <a href='edit/" . $row->{$this->primaryKey} . "'
                                                    class='btn-xs btn-outlined-primary-dark text-center'>
                                                    Edit
                                                </a>
                                            </div>
                                            <div class='col'>
                                                <a href='delete/" . $row->{$this->primaryKey} . "'
                                                    class='btn-xs btn-outlined-error-dark text-center'>
                                                    Delete
                                                </a>
                                            </div>
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
            $html .= "<span class='arrow-icons'>
                    <span class='left-arrow'>
                        <svg width='9' height='15' viewBox='0 0 9 15' fill='none'
                        xmlns='http://www.w3.org/2000/svg'>
                            <path d='M7.10107 13.4121L1.10107 7.41211L7.10107 1.41211'
                                stroke='#B1B1B1' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>
                        </svg>
                    </span>
            
                    <span class='right-arrow'>
                        <svg width='9' height='15' viewBox='0 0 9 15' fill='none'
                            xmlns='http://www.w3.org/2000/svg'>
                                <path d='M1.854 13.3516L7.854 7.35156L1.854 1.35156'
                                    stroke='#B1B1B1' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>
                        </svg>
                    </span>
                  </span>";
            $html .= "</td></tr>";
            $html .= "</tfoot>";
        }

        $html .= "</table>";
        echo $html;
    }
}
