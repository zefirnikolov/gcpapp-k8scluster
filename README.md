# https://www.zefirnikolov.org

**DevOps** - This a simple **Kubernetes (K8s) cluster** website, which contains **web** + **db** parts – **Facts about the USA**. 
It is deployed on **Google Cloud Platform (GCP)** with **Google Kubernetes Engine (GKE)**. The Cluster is **Production Standard**.

![app](app.png)

The **database part** is standard **MariaDB (MySQL)** database which is downloaded as a container, added the init file and then created as Docker Image and uploaded to **Docker Hub again** (See the **database-development** files). It is deployed with the **db.yaml** file. The Persistence of the cluster is insured with the **volume-claim.yaml** which reserves a **google pd-standard volume** with 7Gi in case of the db’s container or pod failure – see the **volume-claim.yaml** file.
The **web part** is a .php file in which the connection is made with the Database and the table **states** from it is exposed on the frontend. See the **webpart-development folder**. Then it files are containerized with - **Nginx web server** with **Php** as a programming language combined in 1 docker image: **webdevops/php-nginx**. The web files are uploaded and a new docker image is created from the Dockerfile responsible to the deployment on the cluster. 
Then it is deployed on the cluster with the **web.yaml** file. For persistence 2 replicas are made. 

The front end is exposed to the internet with **Nginx Ingress Controller** and **Let’s Encrypt TLS/SSL** certificates are obtained with **Cert-Manager**. The ingress object to which they are applied is **public-ingress.yaml** in the **nginx-ingress-plus-cert-manager** folder of the repository (all cert-manager files are in that folder too). The front end trough the ingress controller’s load balancer (and my Domains management) is obtaining the DNSs – **https://zefirnikolov.org** and **https://www.zefirnikolov.org**

Also another ingress object is created and applied to the ingress – **private-ingress.yaml** in the **nginx-ingress-plus-cert-manager** folder of the repository – which applies a **Basic Authentication** and is made only for private entries – **New certificates** are obtained with the Cert Manager and a **new subdomain** is obtained to the DNS for this private entry: **https://graf.zefirnikolov.org**. It requires a username and a password for entry on the DNS – when it’s entered it’s showing just a dummy frontend from my other project. This private entrance is deployed on the cluster as **private-deployment.yaml** .

![pic-private](pic-private.png)
