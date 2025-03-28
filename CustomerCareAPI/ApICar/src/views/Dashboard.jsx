import React from "react";
import { useNavigate } from "react-router-dom";
import axios from "axios";

const Dashboard = () => {
  const navigate = useNavigate();

  const handleLogout = async () => {
    try {
      const token = localStorage.getItem("token");
      await axios.post(
        "http://127.0.0.1:8000/api/logout",
        {},
        { headers: { Authorization: `Bearer ${token}` } }
      );
      localStorage.removeItem("token");
      navigate("/");
    } catch (err) {
      console.error("Logout failed");
    }
  };

  return (
    <div className="flex flex-col items-center justify-center min-h-screen bg-gray-100">
      <h1 className="text-2xl font-bold mb-4">Welcome to Dashboard</h1>
      <button onClick={handleLogout} className="bg-red-500 text-white px-4 py-2">Logout</button>
    </div>
  );
};

export default Dashboard;
