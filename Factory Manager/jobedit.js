let maxEmployees = document.getElementById('initialEmployeeCount');
const container = document.getElementById('input_fields');

maxEmployees = getEmployeeCount();

console.log(maxEmployees);

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

    maxEmployees = getEmployeeCount();
    
    

};

function getEmployeeCount() {
    let count = 0;
    for (let i = 1; i <= 5; i++) {
        if (document.getElementById('employee_' + i)) {
            count++;
        }
    }
    return count;
}


function getNextEmployeeId() {
    let nextId = 1;
    while (document.getElementById('employee_' + nextId)) {
        nextId++;
    }
    return nextId;
}

function addEmployee() {
    if (maxEmployees < 5) {
        maxEmployees++;
        const nextId = getNextEmployeeId();
        
        const field = document.createElement("select");
        field.name = "employee_" + nextId;
        field.id = "employee_" + nextId;

        const defaultOption = document.createElement("option");
        defaultOption.value = "";
        defaultOption.text = "Select an employee";
        field.appendChild(defaultOption);

        
        employeeNames.forEach(function(employee) {
            const option = document.createElement("option");
            option.value = employee.id;
            option.text = employee.name;
            field.appendChild(option);
        });

        const label = document.createElement("label");
        label.htmlFor = "employee_" + nextId;
        label.textContent = "Employee " + nextId;

       
        const descriptionLabel = document.querySelector('label[for="jobDesc"]');
        container.insertBefore(label, descriptionLabel);
        container.insertBefore(field, descriptionLabel);
    } else {
        window.alert("You can only assign a maximum of FIVE employees per Job.");
    }
}

function removeEmployee() {
    if (maxEmployees > 1) {   
        const lastEmployeeId = getNextEmployeeId() - 1;
        const selectToRemove = document.getElementById('employee_' + lastEmployeeId); 
        const labelToRemove = selectToRemove.previousElementSibling;
        container.removeChild(selectToRemove);
        container.removeChild(labelToRemove);
        maxEmployees--;
    } else {
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