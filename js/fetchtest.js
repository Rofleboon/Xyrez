function fetchLogs() {
    const apikey = "4a17488a491b8980ee6c89d6c1ae8b94";
    const url = `https://www.warcraftlogs.com/v1/reports/guild/ist%20Gildenlos/MalGanis/EU?api_key=${apikey}`;
    fetch(url)
      .then((response) => {
        if (!response.ok) {
          throw new Error("Error: Could not fetch data.");
        }
        return response.json();
      })
      .then((data) => {
        const logsContainer = document.querySelector("#logs");
        logsContainer.innerHTML = data
          .slice(0, 15)
          .map((log) => {
            const logDate = new Date(log.start);
            const locale = "de-DE";
            const options = { weekday: "long", year: "numeric", month: "2-digit", day: "2-digit" };
            const formattedDate = logDate.toLocaleDateString(locale, options);
            return `
              <div class="container entry">
                <p class="logname">${formattedDate} ${log.title}</p>
                <a href="https://www.warcraftlogs.com/reports/${log.id}" target="_blank" class="btn btn-primary">Warcraftlogs</a>
                <a href="https://www.wipefest.gg/report/${log.id}" target="_blank" class="btn btn-primary">Wipefest</a>
              </div>`;
          })
          .join("");
      })
      .catch((error) => {
        console.error(error);
      });
  }
  
  fetchLogs();
  