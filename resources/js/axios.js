import axios from "axios";
import store from "~/store";

const token = store.getters["auth/token"];

export const HTTP = axios.create({
  baseURL: `http://127.0.0.1:8000/api`,
  headers: {
    Authorization:
      `Bearer ${token}`
  }
});
export const HTTPWT = axios.create({
  baseURL: `http://127.0.0.1:8000/api`,
});