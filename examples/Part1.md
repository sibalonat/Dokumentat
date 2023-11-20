## Overview
Embark on a journey beyond typical CRUD applications with our tutorial series, where we delve into file management automation using Laravel and OnlyOffice. This series starts with setting up a fresh Laravel application, integrating Vue 3 through Laravel Breeze, and exploring how these tools work in harmony. We’ll also introduce ‘dokumentat’, a custom package, to streamline our process. Look forward to deep dives into advanced features like file conversion, event broadcasting, and Vue.js integration. By the end, you’ll have a robust document management system within your Laravel projects. Get ready to enhance your skills and your projects! 🚀👨‍💻
<br />
---
<br />
This year, I ventured beyond the usual CRUD applications and tackled an exciting challenge involving file management automation. Our team initially considered JavaScript-based solutions, exploring plugins like CKEditor and Quill. However, our specific formatting needs led us to realize these wouldn’t suffice.
<br />
<br />
That’s when we stumbled upon OnlyOffice, an office suite offering an API for online document handling — a game-changer for us. Though not free, its value justifies the cost, especially with its developer edition and SaaS offerings.
<br />
<br />
In this tutorial series, I’ll guide you through integrating OnlyOffice with Laravel. We’ll set up a new Laravel app, install OnlyOffice locally, and explore advanced features like file conversion, event broadcasting, and Vue.js integration. Get ready to enhance your Laravel projects with robust document management capabilities!

--- 
PART 1
<br />
<br />
As a first step, we would need to install a new Laravel application and set everything up. For this tutorial series, I will not use docker, but if you feel more inclined to do so, it would help if you can write in the comment section how did you it so that people who use docker in their environment can pick up.
<br />
<br />
Start Fresh: First, let’s create a new Laravel application. Run this command:
<br />
<br />

```bash
composer create-project laravel/laravel example
```
<br />
<br />
This will create a new Laravel Project and set up the basic configuration.
<br />
<br />
Introducing Breeze: Next, we’ll install Laravel Breeze. It’s a minimal yet powerful starter kit that’ll help us integrate Vue 3 seamlessly. Run:
<br />
<br />

```bash
composer require laravel/breeze –dev
```

<br />
<br />

Configuring Breeze: After installing Breeze, let’s set it up. Execute:
<br />
<br />

```bash
php artisan breeze:install
```

<br />
<br />

In the past, when we installed Breeze we needed also to specify some properties of the installation, such as what bundle (react, vue, livewire, API, and more properties), but now now prompt in the terminal will ask you to choose your stack. For this project, we’re going with Inertia Vue. Just type vue in lowercase.

<br />
<br />

Finalizing the Setup: Most of the subsequent prompts are straightforward. I usually hit enter to accept the defaults. What happens next is Breeze configures Vue 3 in our Laravel app, with Inertia acting as the bridge between the two.

<br />
<br />

Wrapping up this part of our journey, we’ll install the '[‘dokumentat’]'(https://packagist.org/packages/keysoft/dokumentat) package, a creation of mine, and then run migrations. Next time, we’ll dive into setting up OnlyOffice in our environment and integrating it with our application.

<br />
<br />
