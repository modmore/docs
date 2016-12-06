Your git repository is ideally in the root of the MODX site. For GitifyWatch to work, it needs to be able of committing and pushing without any interaction like filling in passwords, so you'll likely want to set up [Deploy Keys](https://developer.github.com/guides/managing-deploy-keys/#deploy-keys) for authentication, without a passphrase.

One way to do it is to set up your origin remote with the format `mycustomhost:organisation/repository.git`, and the following in your `.ssh/config` file:

    Host mycustomhost
      IdentityFile ~/.ssh/my_deploy_key
      User git
      HostName github.com
      
That way you can be very specific about which key file to use for that particular SSH connection.