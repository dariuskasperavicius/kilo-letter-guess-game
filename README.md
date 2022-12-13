# Requirements

## TDD & Live Coding

1. Write a letter guessing game classes
2. Write a simple test, which would allow play empty round
3. We should be able to add at least a three players: 
- drunk - guesses the letters even if they are guessed
- sober - guesses random letter, but not existing and which was not guesed
- smart - guesses letters by popularity
4. Write another tests, which would add ability to play round and test to win the game.
5. Write the code for this

## Architecture, infrastructure and Live coding
6. Make this game autoplay. Write a test. We will need a command with game output.
7. Finally, everybody was happy with a game, how we would add http client?
8. Now as we have many layers, how it will be different in layered architecture, clean and hexagonal?`
9. ---> New feature came: let's make a cli player, which asks for letter and we can enter it and let us play with bots
10. Can we add a undo function? If we want, we can undo our move.
11. New features came in. Our clients wants to make the code memorable. We can quit the game and continue.

Optional:
12. And api for the game to display it on the screen?



#Setup
docker run --name demo -p 6379:6379 redis
docker start demo