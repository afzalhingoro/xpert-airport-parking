/*Airport Datepicker code*/
if(false){
    var enddate = new Date();
    enddate.setDate(enddate.getDate()+ 8);
    new TinyPicker({ 
    format: 'dd-mm-yyyy',
    firstBox:document.getElementById('startDate'), // Required -- Overrides us finding the first input box
    lastBox: document.getElementById('endDate'), // Required -- Overrides us finding the last input box
    startDate: new Date(), // Needs to be a valid instance of Date   
    endDate: enddate, // Needs to be a valid instance of Date
    allowPast: false, // If you want the user to be able to select past dates
    useCache: true, 
    orientation: "top auto",
     horizontal: 'auto',
    vertical: 'auto'
    
    }).init();
}


//FAQS section