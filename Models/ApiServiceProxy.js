import { RealApiService } from './RealApiService.js';

export class ApiServiceProxy {
    constructor() {
        this.realService = new RealApiService();
        this.cache = {}; // Simple cache to store results temporarily
    }

    async fetchAccessToken() {
        if (this.cache.authToken) {
            console.log("Using cached access token.");
            return this.cache.authToken; // Return cached token if available
        }

        console.log("Fetching new access token.");
        const token = await this.realService.fetchAccessToken();
        this.cache.authToken = token; // Cache the token
        return token;
    }

    async fetchCountries() {
        if (this.cache.countries) {
            console.log("Using cached countries.");
            return this.cache.countries; // Return cached countries list if available
        }

        console.log("Fetching countries list.");
        const countries = await this.realService.fetchCountries();
        this.cache.countries = countries; // Cache the countries
        return countries;
    }

    async fetchStates(selectedCountry) {
        if (this.cache[selectedCountry]) {
            console.log(`Using cached states for ${selectedCountry}`);
            return this.cache[selectedCountry]; // Return cached states if available
        }

        console.log(`Fetching states for ${selectedCountry}`);
        const states = await this.realService.fetchStates(selectedCountry);
        this.cache[selectedCountry] = states; // Cache the states for this country
        return states;
    }

    async fetchCities(selectedCity) {
        if (this.cache[selectedCity]) {
            console.log(`Using cached cities for ${selectedCity}`);
            return this.cache[selectedCity]; // Return cached cities if available
        }

        console.log(`Fetching cities for ${selectedCity}`);
        const cities = await this.realService.fetchCities(selectedCity);
        this.cache[selectedCity] = cities; // Cache the cities for this city
        return cities;
    }
}
