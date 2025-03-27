import { useState, useEffect } from "react";
import axios from "axios";
import "./App.css";

function App() {
  const [tickets, setTickets] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    axios
      .get("http://localhost:8000/api/tickets")
      .then((response) => {
        setTickets(response.data);
        setLoading(false);
      })
      .catch((error) => {
        console.error("Error fetching tickets:", error);
        setError("Failed to load tickets");
        setLoading(false);
      });
  }, []);

  return (
    <div className="container">
      <h1>My Tickets</h1>

      {loading && <p>Loading tickets...</p>}
      {error && <p className="error">{error}</p>}

      <ul className="ticket-list">
        {tickets.length > 0 ? (
          tickets.map((ticket) => (
            <li key={ticket.id} className="ticket-item">
              <h3>{ticket.title}</h3>
              <p>{ticket.description}</p>
              <span>Status: {ticket.status}</span>
            </li>
          ))
        ) : (
          !loading && <p>No tickets available.</p>
        )}
      </ul>
    </div>
  );
}

export default App;
