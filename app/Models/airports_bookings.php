<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use App\Models\airport;
use Illuminate\Support\Facades\DB;

class airports_bookings extends Model

{

    //

    protected $table = 'airports_bookings';

    protected $fillable = ["airportID", "companyId", "customerId", "edit_by", "title", "first_name", "last_name", "email", "phone_number", "fulladdress", "address", "address2", "town", "postal_code", "passenger", "referenceNo", "departDate", "deprTerminal", "deptFlight", "returnDate", "returnTerminal", "returnFlight", "no_of_days", "discount_code", "created_at", "booking_status", "payment_status", "removed", "status","old_total_amt", "created_at","refund_method","refund_reason","additional_notes", "", "", "", "", "", "", ""];



    public function company()
    {

        return $this->belongsTo("App\Models\Company", "companyId");
    }

    public function airport()
    {

        return $this->belongsTo("App\Models\airport", "airportID");
    }



    public function admin()
    {

        return $this->belongsTo("App\Models\User", "admin_id");
    }

 


    public function rterminal()
    {

        return $this->belongsTo("App\Models\airports_terminals", "returnTerminal");
    }



    public function dterminal()
    {

        return $this->belongsTo("App\Models\airports_terminals", "deprTerminal");
    }



    public static function getSingleRowById($id)
    {

        return airports_bookings::where("id", $id)->first();
    }
 

    public  function customer()
    {
        return $this->belongsTo("App\Models\customers", "customerId");
    }

    public  function getTranscation()
    {

        // return booking_transaction::where("id",$id)->first();

        return $this->belongsTo("App\Models\booking_transaction", "id");
    }
 
    public function getThisMonthlySale()
    {
        $month = date("m");
    
        $query = $this->select(
            DB::raw('DATE_FORMAT(created_at, "%d") as dayDate'),
            DB::raw('count(*) as total_booking')
        );
    
        $query->whereMonth('created_at', $month);
    
        $query->where("airports_bookings.booking_status", "Completed");
        $query->where("airports_bookings.payment_status", "success");
        $query->where("airports_bookings.removed", "No");
        $query->where("airports_bookings.status", "Yes");
    
        $query->groupBy(DB::raw('DATE_FORMAT(created_at,  "%Y-%m-%d")'), 'created_at');
    
        // dd($query->toSql());
    
        return $query->get();
    }



    
     public  function partner()
    {
  
        return $this->belongsTo("App\Models\partners", "agentID");
    }
    
}
