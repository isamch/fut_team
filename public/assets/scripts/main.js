// call functions :
dragDrop();
searchAoutName();
filterDropDown();
changeFormation();


let updatesStatus = [];


// update array :
function getUpdatesArray(player1, status1, player2, status2) {
  updatesStatus.push({
      cardPlayer1_id: player1,
      cardPlayer1_status: status1,
      cardPlayer2_id: player2,
      cardPlayer2_status: status2
  });


}



// drag and drop :
function dragDrop(){
  const playerCard = document.querySelectorAll('.p-card');
  const dropZon = document.querySelectorAll('.drop-zone');

  playerCard.forEach(singleCard => {
    singleCard.addEventListener('dragstart', ()=>{
      singleCard.classList.add('dragin-now')
    });
    singleCard.addEventListener('dragend', ()=>{
      singleCard.classList.remove('dragin-now');
    });
  });

  dropZon.forEach(boxDrop=>{
    boxDrop.addEventListener('dragover', (e)=>{
      e.preventDefault();
      const dragingElement = document.querySelector('.dragin-now');

      if (boxDrop.dataset.pos == dragingElement.dataset.pos) {
        boxDrop.classList.add('box-green');
      }else{
        boxDrop.classList.add('box-dropin');
      }    

    });

    boxDrop.addEventListener('dragleave', (e)=>{
      e.preventDefault();
      boxDrop.classList.remove('box-green');
      boxDrop.classList.remove('box-dropin');

    });
    
    
    boxDrop.addEventListener('drop', (e)=>{
      e.preventDefault();
      const dragingElement = document.querySelector('.dragin-now');

      // change just in team:
      if (dragingElement.parentElement.id == 'team-zone' && boxDrop.id === 'team-zone') {
    
        if (boxDrop.dataset.pos == dragingElement.dataset.pos) {
            
          [boxDrop.className , dragingElement.className ] = [dragingElement.className , boxDrop.className];

        }
   
      }else{
      
        const parSub = dragingElement.parentElement;

        if (boxDrop.dataset.pos == dragingElement.dataset.pos) {

          [boxDrop.className , dragingElement.className ] = [dragingElement.className , boxDrop.className];
  
          [boxDrop.dataset.status , dragingElement.dataset.status ] = [dragingElement.dataset.status , boxDrop.dataset.status];

          boxDrop.parentElement.appendChild(dragingElement);
  
          parSub.appendChild(boxDrop);
          
      
          
          // functio send update to php : 
          getUpdatesArray( boxDrop.id , boxDrop.dataset.status , dragingElement.id , dragingElement.dataset.status );
            
          sendUpdatesToPhp();

          
        }

      }

      boxDrop.classList.remove('box-green');
      dragingElement.classList.remove('box-green');
                
      boxDrop.classList.remove('box-dropin');
      dragingElement.classList.remove('box-dropin');

      boxDrop.classList.remove('dragin-now');
      dragingElement.classList.remove('dragin-now');
            
    });

  });

}


// send data to php :
function sendUpdatesToPhp() {

  fetch('http://localhost/BRIEF8%20Team/backend/update_status.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify({ updates: updatesStatus })
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
              updatesStatus = [];
          } else {
              console.error('Error:', data.error);
          }
      })
      .catch((error) => {
          console.error('Fetch Error:', error);
      });
}







// search about player :
function searchAoutName() {
  const inputSearch = document.getElementById('search-dropdown');
  
  inputSearch.addEventListener('input', ()=>{
    const playersZone = document.getElementById('side-zone');
    const cards = playersZone.querySelectorAll('.side-card');
    
    cards.forEach(element => {
      const cardPlayerName = element.querySelector('.name-empty').textContent.trim().toLowerCase();

      if ( cardPlayerName.includes(inputSearch.value.toLowerCase()) ) {        
        element.style.display = 'block';
      } else {
        element.style.display = 'none';
      
      }
    });
  });
}



// filter by position:
// dropdown filter : 
function filterDropDown() {
  const filterBtnChoice = document.getElementById('dropdown-button');
  const choiceBtn = document.getElementById('dropdown').querySelectorAll('button');
  choiceBtn.forEach(element => {
    element.addEventListener('click', ()=>{
      const playersZone = document.getElementById('side-zone');
      const cards = playersZone.querySelectorAll('.side-card');
            
      const yourChoice = element.textContent;
      
      filterBtnChoice.firstChild.textContent = yourChoice;
      

      cards.forEach(element => {

        const cardPlayerName = element.dataset.pos;
        if (yourChoice == 'ALL') {
          element.style.display = 'block';
        }else if (yourChoice == cardPlayerName) {
          
          element.style.display = 'block';
        } else {
          element.style.display = 'none';
        
        }
      });

      filterBtnChoice.click();

    });
  });
}







// change formation team:
// choose options :

function changeFormation() {
  const optionFormation = document.getElementById('teamformation');
  
  optionFormation.addEventListener('change', () => {
    
    if (optionFormation.value == "442") {
      const parTeam = document.getElementById('team-zone');
      const allCardTeamFormation = parTeam.querySelectorAll('.empty-card');

      allCardTeamFormation.forEach(element => {
        element.classList.add('second-plan');
        
      });

    }
    
    if (optionFormation.value == "433") {
      
      const parTeam = document.getElementById('team-zone');
      const allCardTeamFormation = parTeam.querySelectorAll('.empty-card');

      allCardTeamFormation.forEach(element => {
        element.classList.remove('second-plan');
        
      });

    }
      

  });
  
};

