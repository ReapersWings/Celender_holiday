<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button type="button" onclick= "lastmonth()" id="back">back</button>
    <button type="button" onclick= "nextmonth()"  id="next">next</button>
    <table>
        <thead>
            <tr>    
                <th id="display" colspan="7"></th>
            </tr>
            <tr>
                <th>su</th> 
                <th>mo</th>
                <th>tu</th>
                <th>we</th>
                <th>th</th>
                <th>fr</th>
                <th>sa</th>
                
            </tr>
        </thead>
        <tbody id="calender">

        </tbody>
    </table>
</body>
</html>
<script>
    let montheng =["","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];   
    /*let arr = [] ;
    function displayholiday(year) {
        let display = year.toString();
        fetch("https://publicholidays.com.my/penang/"+display+"-dates/")
        .then(response => response.text())
        .then(displaytext =>{
            const output=document.createElement("div")
            output.innerHTML=displaytext
            const disply = output.querySelectorAll(".publicholidays tbody tr td");
            console.log(disply);
                arr+=element 
        })
        //return arr ;
    }*/
let arr=[];
function fetchholiday(year){
let a=year.toString();
fetch("https://publicholidays.com.my/penang/"+a+"-dates/")
.then(response => response.text())
    .then(html => {
        const tempElement = document.createElement("div");
        tempElement.innerHTML = html;
        const tableContent = tempElement.querySelectorAll(".publicholidays tbody tr");
        arr=[];
        if (tableContent) {
            tableContent.forEach(eachrow=>{
                let firstc=eachrow.firstChild.innerHTML;
                if(firstc.length<10){
                    arr.push(firstc);
                }
            })
        }
    })
    .catch(error => {
        console.error(error);
    });
    return arr;
}
    //displayholiday(2024);
    fetchholiday(new Date().getFullYear());
    console.log( arr );

    let display = document.getElementById("calender")

    function calender(year, month) {
        let getdate =new Date(year , month-1 , 1).getDay();
        console.log("date :"+getdate);

        let getlastdate = new Date(year , month  , 0).getDate();
        console.log("last date :"+getlastdate);
        display.innerHTML="";
        var date = 1 ;

        for (let index = 0; index < 6; index++) {
            display.innerHTML+="<tr id='"+index+"'>";
            let listoutdate = document.getElementById(index)
            let holiday =fetchholiday(year) ;
            //console.log(holiday)
                for (let loop = 0; loop < 7; loop++) {
                    if (date === 1 && loop != getdate) {
                        listoutdate.innerHTML+="<td></td>";
                    }else if (getlastdate >= date) {
                        let changeholiday = date.toString()+" "+montheng[month]
                        //console.log(changeholiday)
                        if (holiday.includes(changeholiday)==true) {
                            listoutdate.innerHTML+="<td style='background-color:green;'>"+date+"</td>";
                        } else {
                            listoutdate.innerHTML+="<td style='background-color:white;'>"+date+"</td>";
                        }   
                        document.getElementById("display").innerHTML="month :"+montheng[month]+" year :"+year
                        date+=1 ;
                        //return Date; 
                    }else{
                        listoutdate.innerHTML+="<td></td>";
                    }
                    
                }
            
        }
    }
    //calender(2024,2)
    const malaysiadate = new Date().toLocaleString("en-US", { timeZone: "Asia/Kuala_Lumpur" });
    var examplemonth =new Date(malaysiadate)
    var monthdisplay= examplemonth.getMonth()+1
    var exampleyear = new Date(malaysiadate) 
    var yearsdisplay= exampleyear.getFullYear() 
    calender(yearsdisplay, monthdisplay)    
    function nextmonth() {
        if (monthdisplay === 12) {
            monthdisplay -=11 ;
            yearsdisplay +=1 ;
        }else{
            monthdisplay +=1
        }
        calender(yearsdisplay, monthdisplay)
    }
    function lastmonth() {
        if (monthdisplay === 1) {
            monthdisplay += 11 ;
            yearsdisplay-=1 ;
        }else{
            monthdisplay-=1
        }
        calender(yearsdisplay, monthdisplay)
    }
</script>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

h1 {
    text-align: center;
}

button {
    padding: 10px 20px;
    margin: 10px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #45a049;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: white;
}

th, td {
    padding: 15px;
    border: 1px solid #ddd;
    text-align: center;
    font-size: 18px;
}

thead th {
    background-color: #f2f2f2;
    color: #333;
    font-size: 20px;
}

#display {
    font-weight: bold;
    background-color: #4CAF50;
    color: white;
    padding: 10px 0;
}

tbody td {
    width: 14.28%; /* Equal width for 7 days */
    height: 100px;
    vertical-align: middle;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

tbody td:hover {
    background-color: #f0f0f0;
}

tbody td[style*="background-color:green;"] {
    background-color: #e0ffe0 !important; /* Softer green for holidays */
}

@media screen and (max-width: 768px) {
    th, td {
        padding: 10px;
        font-size: 16px;
    }
    
    button {
        font-size: 14px;
   
    }
}
</style>