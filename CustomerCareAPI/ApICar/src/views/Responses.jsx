import { useState, useEffect } from "react";
import axios from "axios";
// import "./App.css";

function Responses() {
  const [responses, setResponse] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    axios
      .get("http://localhost:8000/api/responses")
      .then((response) => {
        setResponse(response.data);
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
      <h1>My Responses</h1>

      {loading && <p>Loading Responses...</p>}
      {error && <p className="error">{error}</p>}

      <ul className="response-list">
        {responses.length > 0 ? (
          responses.map((response) => (
            <li key={response.id} className="response-item">
              <h3>{response.message}</h3>
              <p>user_is :{response.ticket_id}</p>
              <span>user_id: {response.user_id}</span>
            </li>
          ))
        ) : (
          !loading && <p>No responses available.</p>
        )}
      </ul>
    </div>
  );
}

export default Responses;