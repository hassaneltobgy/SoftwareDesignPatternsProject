export class RealApiService {
    constructor() {
        // Define common attributes for the API request
        this.apiToken = "28bw_jecK5jBcvisvVrNU38G63Q27u9EmFrkIyETZLboCT4zHcP5o3w3KquHwQJn66Q"; // Replace with your actual API token
        this.userEmail = "faridaelhusseinynew@gmail.com"; // Replace with your actual email
        this.baseUrl = "https://www.universal-tutorial.com/api"; // Base URL for the API
        this.token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjp7InVzZXJfZW1haWwiOiJmYXJpZGFlbGh1c3NlaW55bmV3QGdtYWlsLmNvbSIsImFwaV90b2tlbiI6IjI4YndfamVjSzVqQmN2aXN2VnJOVTM4RzYzUTI3dTlFbUZya0l5RVRaTGJvQ1Q0ekhjUDVvM3czS3F1SHdRSm42NlEifSwiZXhwIjoxNzM3MTE5MjkyfQ.VTMSPNslt_KJKObndkf5xzXFg2m2Aj1Lzm-2d8b_TkM"; // Replace with your actual token

    }

    // Helper method to get common headers for the API calls
    getHeaders() {
        return {
            "Accept": "application/json",
            "api-token": this.apiToken,
            "user-email": this.userEmail
        };
    }

    // Fetch access token
    async fetchAccessToken() {
        const url = `${this.baseUrl}/getaccesstoken`;
        const headers = this.getHeaders();
        
        const response = await fetch(url, { method: "GET", headers });
        if (!response.ok) {
            throw new Error("Failed to fetch access token");
        }
        const data = await response.json();
        return data.auth_token;
    }

    // Fetch countries
    async fetchCountries() {
        const url = `${this.baseUrl}/countries/`;
        const headers = {
            ...this.getHeaders(),
            "Authorization": `Bearer ${this.token}` // Add token dynamically
        };
        
        const response = await fetch(url, { method: "GET", headers });
        if (!response.ok) {
            throw new Error('Error fetching countries');
        }
        return await response.json(); // Return the countries array
    }

    // Fetch states for the selected country
    async fetchStates(selectedCountry) {
        const url = `${this.baseUrl}/states/${selectedCountry}`;
        const headers = {
            ...this.getHeaders(),
            "Authorization": `Bearer ${this.token}` // Add token dynamically
        };

        const response = await fetch(url, { method: 'GET', headers });
        if (!response.ok) {
            throw new Error(`Error fetching states for ${selectedCountry}`);
        }
        return await response.json();
    }

    // Fetch cities for the selected state
    async fetchCities(selectedCity) {
        const url = `${this.baseUrl}/cities/${selectedCity}`;
        const headers = {
            ...this.getHeaders(),
            "Authorization": `Bearer ${this.token}` // Add token dynamically
        };

        const response = await fetch(url, { method: 'GET', headers });
        if (!response.ok) {
            throw new Error(`Error fetching cities for ${selectedCity}`);
        }
        return await response.json();
    }
}
