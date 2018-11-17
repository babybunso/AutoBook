using System;
using System.Collections.Generic;

namespace Digify
{
    interface IRatingSystem
    {
        Rate GetRate();
        Bond GetBond();
        EstimatedCharge GetEstimatedCharge();
    }
}