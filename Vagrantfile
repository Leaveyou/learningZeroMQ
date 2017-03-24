# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
    config.vm.box = "ubuntu/trusty64"
	config.vm.network "private_network", ip: "100.100.100.2"
  
	config.vm.define :zeroMQ do |t|
	    config.vm.hostname = "ZeroMQ"
    end

    config.vm.synced_folder ".", "/var/www", type: "virtualbox"
    config.vm.synced_folder ".", "/vagrant", disabled: true 

  	## proxy configuration
	if Vagrant.has_plugin?("vagrant-proxyconf")
		config.proxy.http     = "http://proxy.avangate.local:8080"
		config.proxy.https    = "http://proxy.avangate.local:8080"
		config.proxy.no_proxy = "localhost,127.0.0.1,infra,.local"
	end
	
	config.vm.provider "virtualbox" do |vb|
	    # vb.gui = true
	    vb.memory = "512"
	end


	## provisioning scripts  
	config.vm.provision "shell", inline: <<-SHELL
        apt update
		apt install -y build-essential libtool autoconf uuid-dev php5 php5-dev pkg-config git libzmq3 libzmq3-dev
        echo "" | pecl install zmq-beta
        echo "extension=zmq.so" > /etc/php5/cli/conf.d/zmq.ini
	SHELL

##	config.vm.provision "shell" do |s|
##        s.path = "vagrant/provision.sh"
##    end
	

end
