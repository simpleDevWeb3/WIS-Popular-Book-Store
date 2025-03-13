<?php 
// todo paging class 
class Paging{
  public $limit;      // Page size
  public $page;       // Current page
  public $item_count; // Total item count
  public $page_count; // Total page count
  public $result;     // Result set (array of records)
  public $count;      // Item count on the current page
  public $offset;
  private $db;

    public function __construct(Database $db, $query,$params,$limit,$page)
    {
    //construct databse
      $this->db =$db;
   
      // ctype_digit($limit) -> ensure valid integer 
      $this->limit = is_numeric($limit) ? (int)$limit : 10; // Ensure limit stays as an integer
      //If $limit is invalid, the default value 10 is used.
  
      $this->page = is_numeric($page) ? max((int)$page, 1) : 1;

    


      //Set[item count]
      $q = preg_replace('/SELECT\s+.+?\s+FROM\s+/i', 'SELECT COUNT(*) FROM ', $query,1);//Modify SQL Query to Count Total Items
      $stmt = $this->db->query($q,$params);
      $this->item_count = (int)$stmt->fetchColumn();
   
      //Set[page count]
      //53 product / number item perpage 10 = 5.3  -> sum to 6 page
      $this->page_count = ceil($this->item_count/$this->limit);
      
      //Calculate offset: Define where to start fetch record
      $this->offset = ($this->page-1)*$this->limit;
   
      
      //Set [result]
      $stm = $db->query($query . " LIMIT $this->offset,$this->limit " , $params); // it will change original query adding  . " LIMIT $offset,$this->limit"
                                                                         // eg.SELECT * FROM products WHERE category_id = ? LIMIT 10, 10;

      
      $this->result = $stm -> fetchAll();

      $this->count = count($this->result);

    
      
     
  }

  public function html($href = '', $attr = ''){
    if(!$this->result) return;

    //genearate page
    $prev = max($this->page - 1,1);
    $next  = min($this->page + 1, $this->page_count);

    echo "<div class='pager' $attr>";
    echo "<a href='?page=1&$href'>First</a>";
    echo "<a href='?page=$prev&$href'>Previous</a>";
    
    // prev [1][2][3][4] next
    for ($p = 1; $p <= $this->page_count; $p++) {
        $c = $p == $this->page ? 'active' : '';
        echo "<a href='?page=$p&$href' class='$c'>$p</a>";
    }
    
    echo "<a href='?page=$next&$href'>Next</a>";
    echo "<a href='?page=$this->page_count&$href'>Last</a>";
    echo "</div>";
    
  }
}
?>