import { PUBLIC_API_URL, PUBLIC_PLACES_API_KEY } from '$env/static/public';

export default {
	apiUrl: PUBLIC_API_URL || 'http://localhost:8000',
	placesApiKey: PUBLIC_PLACES_API_KEY || ''
};
