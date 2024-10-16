var maxEmployees = 1;
const container = document.getElementById('input_fields');




window.onload = function() {
    const today = new Date().toISOString().split('T')[0];

  
    const dateInput = document.getElementById('jobDate');
    if(dateInput) {
        dateInput.value = today;
        dateInput.min = today;  
    }
    
    const dateEditInput = document.getElementById('jobEditDate');
    if(dateEditInput) {
        dateEditInput.min = today; 
        //base value is populated by php
    }
    
    employeeNameSet.slice(1).forEach(function(){
         addEmployee();
    });
};







function addEmployee() {
    if (maxEmployees < 5) {
        maxEmployees++;
        const field = document.createElement("select");
        field.name = "employee_" + maxEmployees;
        field.id = "employee_" + maxEmployees;

        // Populate the select options with EmployeeID as value and the name as label
        employeeNames.forEach(function(employee) {
            const option = document.createElement("option");
            option.value = employee.id;
            option.text = employee.name;
            field.appendChild(option);
        });

        var desc = document.getElementById("employee_1");
        container.insertBefore(field, desc);

        
    } else {
        window.alert("You can only assign a maximum of FIVE employees per Job.");
    }
}

function removeEmployee(){
    if (maxEmployees > 1)
    {   
        
        const selectToRemove = document.getElementById(('employee_' + maxEmployees)); 
        container.removeChild(selectToRemove);
        maxEmployees--;
        
        
        

    }
    else{
        window.alert("You need a minimum of ONE employee assigned to the job");
    }
    

}

function validateEmployeeData(){

    const nameCheck = document.getElementById("jobName");
    if (jobName.value === ""){
        window.alert("PLEASE ENTER A JOB NAME");
        return false;
    }

    const firstCheck = document.getElementById("employee_1");
    if (firstCheck.value == "Select an employee" && maxEmployees > 1) 
    {
        window.alert("PLEASE ENTER ALL CORRECT NAMES");
        return false;
    }
    else if (firstCheck.value == "Select an employee"){
        window.alert("YOU MUST ENTER AT LEAST ONE EMPLOYEE NAME");
        return false;
    }

/* COMPARISON OF ALL VALUES BEFORE POSTING*/
  for (let i = 1; i <= maxEmployees; i++){
    for(let j = i + 1; j <= maxEmployees; j++){

        const empCompare = document.getElementById("employee_" + i);
        const empCompares = document.getElementById("employee_" + j);
    
        console.log("EMPCOMPARE " + empCompare.value);
        console.log("empcompares " + empCompares.value);
    
        if(empCompare.value == empCompares.value)
        {
            window.alert("ERROR YOU CANNOT HAVE TWO OF THE SAME EMPLOYEE");
            return false;
        }
    }
  }

  const description = document.getElementById("jobDesc");
  if(description.value === ""){
    window.alert("PLEASE ENTER A BRIEF DESCRIPTION");
    return false;
  }
  
  return true;
}


function testmachine(){

    const machineTest = document.getElementById("employee_1");
    var machTest = machineTest.value;
    window.alert(machTest);
}