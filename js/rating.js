var stars = document.getElementsByClassName('rate-star');
var curRate = 0;

function RateHover(index, left, right)
{
    if (event.clientX > stars[index].offsetLeft && event.clientX < stars[index].offsetLeft + 32)
    {
        curRate = left;
    }
    else if (event.clientX > stars[index].offsetLeft + 32 && event.clientX < stars[index].offsetLeft + 64)
    {
        curRate = right;
    }

    console.log(curRate);

    for (var x = 0; x < stars.length; x++)
    {
        stars[x].classList = "icon-star-empty rate-star";
    }

    for (var i = 0; i < Math.ceil(curRate / 2); i++)
    {
        if (i == Math.ceil(curRate / 2) - 1)
        {
            if (curRate % 2 != 0)
            {
                stars[i].classList = "icon-star-half-alt rate-star";
            }
            else
            {
                stars[i].classList = "icon-star rate-star";
            }
        }
    }
}