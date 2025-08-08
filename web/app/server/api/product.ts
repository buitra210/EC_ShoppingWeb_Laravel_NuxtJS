import axios from "~/libs/axios";

export class ProductApiService {
  static async getProductNewArrivals() {
    const response = await axios.get("/api/products/new-arrivals");
    return response.data;
  }
  static async getProductBestSellers() {
    const response = await axios.get("/api/products/best-sellers");
    return response.data;
  }
  static async getProductBestPrice() {
    const response = await axios.get("/api/products/best-price");
    return response.data;
  }
}
