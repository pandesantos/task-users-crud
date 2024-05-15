### Requirements
- PHP 8.2

## Installation Guide
1. Clone the repository
2. Run command `composer install`
3. Copy .env.example to .env
4. Replace value of `VITE_API_URL` to served laravel app url
5. Replace value of `MOCK_API_URL` as `https://664478bd6c6a6565870aa445.mockapi.io/api` for testing or any url created with mock api
5. Run Command `npm install` on the same project directory
6. Run `npm run dev` to run the frontend
7. Since the Vue is combined with the laravel all the view part has 
been rendered using vue js (Either laravel app url or frontend url should work)


### Screenshots
1. Users List
![List of users](/public/screenshots/list.png)
