NAME:=hourofcode
TAG:=first
PORT_SSH:=2002
PASSWORD:=password

build:
	docker build -t "${NAME}:${TAG}" --build-arg PASSWORD=${PASSWORD} --pull .

run:
	docker run --rm --hostname=${NAME} -it -p 80:80 -p ${PORT_SSH}:22 "${NAME}:${TAG}"


clean:
	docker image rm -f "${NAME}:${TAG}"

