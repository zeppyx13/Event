
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.23.0/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.23.0/firebase-analytics.js";
const firebaseConfig = {
    apiKey: "AIzaSyDdjD86Ynr4XA9ChRUMnT9GYb4p6yMXOXM",
    authDomain: "drive-jb-pay.firebaseapp.com",
    projectId: "drive-jb-pay",
    storageBucket: "drive-jb-pay.appspot.com",
    messagingSenderId: "598069864402",
    appId: "1:598069864402:web:f00900a1d9d2e710dcca0b",
    measurementId: "G-JTQH2WDDNX"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
