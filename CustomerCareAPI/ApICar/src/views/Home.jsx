import React from "react";

const Home = () => {
  return (
    <div className="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-6">
      <div className="max-w-3xl bg-white shadow-lg rounded-2xl p-8 text-center">
        <h1 className="text-4xl font-bold text-gray-800 mb-4">CustomerCareAPI</h1>
        <p className="text-gray-600 text-lg mb-6">
          CustomerCareAPI est une API avancée développée en Laravel pour la gestion d’un service client.
        </p>
        <p className="text-gray-600 text-md mb-6">
          Gérez les tickets d’assistance, attribuez des demandes aux agents, suivez l’état des requêtes et consultez
          l’historique des interactions. Cette API REST robuste respecte les meilleures pratiques et peut être consommée
          via Vue.js, React ou Angular.
        </p>
        <button className="bg-blue-600 text-white px-6 py-3 rounded-full text-lg font-semibold shadow-md hover:bg-blue-700 transition duration-300">
          En savoir plus
        </button>
      </div>
    </div>
  );
};

export default Home;
