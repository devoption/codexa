# DevOption Codexa

Codexa is a static documentation site generator for Software Engineering teams. It is built using the [Laravel](https://laravel.com/) framework and uses Git as a data source for the documentation.

Documentation for your projects is important. It helps you and your team to understand the project and how it works. It also helps other people to understand your project and how to use it. 

> If you are working on an open source project, documentation is even more important. It helps other people to understand your project and how to use it. It also helps you to get more contributors and more users.

Codexa is here to help you organize and deliver your documentation that is simple to maintain and easy to use.

## Getting Started

To start using Codexa, you need to create a new Git repository to store your documentation in Markdown format. You can use any Git hosting service you want. We recommend using [GitHub](https://github.com) or [GitLab](https://gitlab.com). 

> You can use an existing repository if you want. But we recommend creating a new one.

Once you have created your repository, you can use Docker to run Codexa. You can use the following command to run Codexa:

```bash
docker run -d \
    -e DOCS_REPOSITORY=https://github.com/devoption/docs.git \
    -e DOCS_BRANCH=main \
    -e DOCS_ACCESS_TOKEN=<your-personal-access-token> \
    -p 80:80 \
    -v devoption/codexa
```

Running this Docker command will start Codexa and it will automatically fetch your documentation from your Git repository. You can then access your documentation on port 80 (or any port you entered into the command).

Codexa will then automatically fetch your documentation from your Git repository every hour. You can change this interval by setting the `DOCS_FETCH_INTERVAL` environment variable.

And that's it! You are now ready to start using Codexa.

## Screenshots

![Codexa Screenshot - Light](https://github.com/devoption/codexa/blob/main/docs/images/codexa-screenshot-light.png)
![Codexa Screenshot - Dark](https://github.com/devoption/codexa/blob/main/docs/images/codexa-screenshot-dark.png)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Security Vulnerabilities

If you discover a security vulnerability within Codexa, please send an e-mail to [Codexa](mailto:security@devoption.io). All security vulnerabilities will be promptly addressed.
