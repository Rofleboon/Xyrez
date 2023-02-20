function fetchdata() {
    fetch('https://www.warcraftlogs.com:443/v1/reports/guild/ist%20Gildenlos/MalGanis/EU?api_key=4a17488a491b8980ee6c89d6c1ae8b94')
      .then(res => {
        if (!res.ok) {
          throw Error("API is down");
        }
        return res.json()
      })
      .then(data => {
        const html = data.slice(0, 15).map(wcl =>{              
            return `
            <div class="container entry">
                <p class="logname">${timeConverter(wcl.start)} ${wcl.title}</p>
                <a href="https://www.warcraftlogs.com/reports/${wcl.id}" target="_blank" class="btn btn-wcl">Warcraftlogs</a>
                <a href="https://www.wipefest.gg//report/${wcl.id}" target="_blank" class="btn btn-wf">Wipefest</a>
            </div>
        `                        
        }).join('')            
        document
          .querySelector('#logs')
          .insertAdjacentHTML('afterbegin', html);
      })
      .catch(error => {
        // display error message to the user
        document.querySelector('#logs').innerHTML = "<p>Failed to load logs. Please try again later.</p>";
        console.log(error);
      });
  }
  
  function getDayName(dateStr, locale) {
    var date = new Date(dateStr);
    return date.toLocaleDateString(locale, { weekday: 'long' });        
  }
  
  function timeConverter(UNIX_timestamp) {
    var a = new Date(UNIX_timestamp);
    var months = ['01','02','03','04','05','06','07','08','09','10','11','12'];
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    var date = a.getDate();
    var hour = a.getHours();
    var min = a.getMinutes();
    var sec = a.getSeconds();
    var day = getDayName(a, "de-DE");
    var time = day + ', ' + date + '.' + month + '.' + year;
    return time;
  }
  
  fetchdata();
  