# laravel-doctrine-app

## Laravel doctrine example

## Whats inside

- Laravel 5.2.*
- Laravel doctrine ORM, [docs](http://www.laraveldoctrine.org/docs/1.1/orm)
- Laravel doctrine ACL, [docs](http://www.laraveldoctrine.org/docs/1.1/acl)
- Annotations, [docs](https://laravelcollective.com/docs/5.2/annotations)
- Forms & HTML, [docs](https://laravelcollective.com/docs/5.2/html)
- Socilate, [docs](https://github.com/laravel/socialite)
- Socilate provider vkontakte,  [docs](http://socialiteproviders.github.io/providers/vkontakte/)
- Debug-bar
- Twitter bootstrap 4, via bower

## Settings

**.env**

```DOCTRINE_LOGGER=LaravelDoctrine\ORM\Loggers\LaravelDebugbarLogger``` logger for doctrine queries, to see it in debug bar.
* * *

```
VKONTAKTE_KEY=xxx
VKONTAKTE_SECRET=xxxx
VKONTAKTE_REDIRECT_URI=http://xxxx
```
VK social provider settings.

### About

Base controller implements EntityManager injection, so if you extend it you can use in your controller something like:
```
$this->em->getRepository(\App\Entities\User::class)->findAll();
```
Creating new user

```
 /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = new \App\Entities\User();

        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword(bcrypt($data['password']));

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
```
Validator, uniq email ``` 'email' => 'required|email|max:255|unique:App\Entities\User,email', ```
